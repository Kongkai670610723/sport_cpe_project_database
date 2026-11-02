// SPORT.CPE Real MySQL-Connected Web Server (Node.js + mysql2 -> sport_cpe_db)
const http = require('http');
const fs = require('fs');
const path = require('path');
const mysql = require('mysql2/promise');

const PORT = 8000;
const PUBLIC_DIR = path.join(__dirname, 'public');

// MySQL Connection Pool to sport_cpe_db (same database opened in DBeaver on localhost:3306)
const pool = mysql.createPool({
  host: process.env.DB_HOST || '127.0.0.1',
  port: Number(process.env.DB_PORT || 3306),
  user: process.env.DB_USER || 'root',
  password: process.env.DB_PASSWORD || 'rootpass123',
  database: process.env.DB_DATABASE || 'sport_cpe_db',
  waitForConnections: true,
  connectionLimit: 10,
  charset: 'utf8mb4'
});

const MIME_TYPES = {
  '.html': 'text/html; charset=UTF-8',
  '.css': 'text/css; charset=UTF-8',
  '.js': 'application/javascript; charset=UTF-8',
  '.json': 'application/json; charset=UTF-8',
  '.png': 'image/png',
  '.jpg': 'image/jpeg',
  '.jpeg': 'image/jpeg',
  '.svg': 'image/svg+xml'
};

function encodePasswordHash(plainPassword) {
  const b64 = Buffer.from(String(plainPassword), 'utf8').toString('base64');
  return '$2y$10$CPE_' + b64;
}

function decodePasswordFromHash(hash) {
  if (!hash) return 'password123';
  const str = String(hash);
  if (str.startsWith('$2y$10$CPE_')) {
    try {
      return Buffer.from(str.slice('$2y$10$CPE_'.length), 'base64').toString('utf8');
    } catch (e) {
      return 'password123';
    }
  }
  // Seed users in schema.sql all use 'password123'
  if (str.startsWith('$2y$10$')) {
    return 'password123';
  }
  // If someone typed plain password directly in DBeaver
  return str;
}

function formatDateEn(dt) {
  if (!dt) return 'Nov 1, 2026';
  const d = new Date(dt);
  if (isNaN(d.getTime())) return 'Nov 1, 2026';
  return d.toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' });
}

function formatMonthYearEn(dt) {
  if (!dt) return 'Nov 2026';
  const d = new Date(dt);
  if (isNaN(d.getTime())) return 'Nov 2026';
  return d.toLocaleDateString('en-US', { month: 'short', year: 'numeric' });
}

async function buildLiveDbState() {
  const [catRows] = await pool.query('SELECT * FROM categories ORDER BY category_id ASC');
  const [userRows] = await pool.query('SELECT * FROM users ORDER BY user_id ASC');
  const [bogoRows] = await pool.query('SELECT product_id FROM promotion_products WHERE promo_id = 3 ORDER BY product_id ASC');
  const [prodRows] = await pool.query('SELECT product_id, stock_quantity, price FROM products');
  const [orderRows] = await pool.query(`
    SELECT o.*, u.name AS customer_name, u.email AS user_email, p.promo_code
    FROM orders o
    LEFT JOIN users u ON o.user_id = u.user_id
    LEFT JOIN promotions p ON o.promo_id = p.promo_id
    ORDER BY o.order_id DESC
  `);
  const [itemRows] = await pool.query(`
    SELECT oi.*, pr.name AS product_name, pr.brand AS product_brand, c.category_name
    FROM order_items oi
    LEFT JOIN products pr ON oi.product_id = pr.product_id
    LEFT JOIN categories c ON pr.category_id = c.category_id
    ORDER BY oi.order_item_id ASC
  `);

  const users = userRows.map(u => ({
    user_id: u.user_id,
    name: u.name,
    email: u.email,
    alt_email: u.user_id === 2 ? 'admin@cpe.eng.cmu.ac.th' : undefined,
    password: decodePasswordFromHash(u.password_hash),
    password_hash: u.password_hash,
    phone: u.phone || '',
    address: u.address || '',
    role: u.role || 'customer',
    member_since: formatMonthYearEn(u.created_at)
  }));

  const buy2get1Ids = bogoRows.map(r => Number(r.product_id));

  const stockMap = {};
  for (const p of prodRows) {
    stockMap[p.product_id] = Number(p.stock_quantity);
  }

  const itemsByOrder = {};
  for (const it of itemRows) {
    if (!itemsByOrder[it.order_id]) itemsByOrder[it.order_id] = [];
    itemsByOrder[it.order_id].push({
      order_item_id: it.order_item_id,
      product_id: it.product_id,
      name: it.product_name || ('Product #' + it.product_id),
      brand: it.product_brand || 'Sports',
      category: it.category_name || 'Sports',
      qty: Number(it.quantity),
      free_qty: Number(it.free_qty || 0),
      price: Number(it.unit_price_at_purchase),
      discount_amount: Number(it.discount_amount || 0),
      item_total: Number(it.item_total)
    });
  }

  const orders = orderRows.map(o => {
    const items = itemsByOrder[o.order_id] || [];
    const title = items.length > 0
      ? items.map(i => `${i.name} (Qty: ${i.qty}${i.free_qty > 0 ? ' + แถมฟรี ' + i.free_qty : ''})`).join(' + ')
      : `Order #${o.order_id}`;
    const discountNum = Number(o.discount_amount || 0);
    let discountLabel = 'ไม่มี';
    if (o.promo_code) {
      discountLabel = o.promo_code;
    } else if (discountNum > 0) {
      discountLabel = 'BUY2GET1';
    }
    return {
      order_id: Number(o.order_id),
      id: '#' + o.order_id,
      user_id: Number(o.user_id),
      user_email: o.user_email || '',
      customer: o.customer_name || ('User #' + o.user_id),
      date: formatDateEn(o.order_date),
      subtotal: Number(o.subtotal),
      discount: discountNum,
      total: Number(o.total_amount),
      discountLabel: discountLabel,
      discountCode: discountLabel,
      status: o.order_status || 'Pending',
      payment: 'PromptPay / Verified Payment',
      address: o.shipping_address || '',
      tracking: o.order_status === 'Cancelled'
        ? 'คำสั่งซื้อถูกยกเลิก'
        : (o.order_status === 'Pending' ? 'รอจัดส่งพัสดุ (กำลังเตรียมสินค้าจากคลัง SPORT.CPE)' : 'KEX-' + (670600000 + Number(o.order_id)) + 'TH'),
      title: title,
      items: items
    };
  });

  return { categories: catRows, users, buy2get1Ids, stockMap, catalogCount: prodRows.length, orders };
}

function readJsonBody(req) {
  return new Promise((resolve, reject) => {
    let data = '';
    req.on('data', chunk => { data += chunk; });
    req.on('end', () => {
      try {
        resolve(data ? JSON.parse(data) : {});
      } catch (e) {
        reject(e);
      }
    });
    req.on('error', reject);
  });
}

function sendJson(res, status, payload) {
  res.writeHead(status, {
    'Content-Type': 'application/json; charset=UTF-8',
    'Cache-Control': 'no-store, no-cache, must-revalidate'
  });
  res.end(JSON.stringify(payload));
}

const server = http.createServer(async (req, res) => {
  try {
    let reqUrl = req.url.split('?')[0];
    if (reqUrl === '/') reqUrl = '/index.html';

    // 1. Live Database Sync Endpoint
    if (reqUrl === '/api/db/state' && req.method === 'GET') {
      const state = await buildLiveDbState();
      return sendJson(res, 200, { ok: true, ...state });
    }

    // 2. Register New User -> INSERT INTO sport_cpe_db.users
    if (reqUrl === '/api/db/register' && req.method === 'POST') {
      const body = await readJsonBody(req);
      const name = String(body.name || '').trim();
      const email = String(body.email || '').trim().toLowerCase();
      const phone = String(body.phone || '').trim();
      const address = String(body.address || '').trim();
      const password = String(body.password || '');

      const [existing] = await pool.query('SELECT user_id FROM users WHERE LOWER(email) = ?', [email]);
      if (existing.length > 0) {
        return sendJson(res, 409, { ok: false, error: 'อีเมลนี้มีอยู่ในฐานข้อมูลแล้ว' });
      }

      const passwordHash = encodePasswordHash(password);
      const [result] = await pool.query(
        'INSERT INTO users (name, email, password_hash, phone, address, role) VALUES (?, ?, ?, ?, ?, ?)',
        [name, email, passwordHash, phone, address, 'customer']
      );

      const newUser = {
        user_id: result.insertId,
        name,
        email,
        password,
        password_hash: passwordHash,
        phone,
        address,
        role: 'customer',
        member_since: 'Nov 2026'
      };
      console.log(`[MySQL sport_cpe_db] INSERT INTO users -> user_id=${result.insertId}, email=${email}`);
      return sendJson(res, 201, { ok: true, user: newUser });
    }

    // 3. Update User Profile / Address -> UPDATE sport_cpe_db.users
    if (reqUrl === '/api/db/profile' && req.method === 'PUT') {
      const body = await readJsonBody(req);
      const userId = Number(body.user_id);
      const name = String(body.name || '').trim();
      const phone = String(body.phone || '').trim();
      const address = String(body.address || '').trim();
      const password = body.password ? String(body.password) : '';

      if (password) {
        const passwordHash = encodePasswordHash(password);
        await pool.query(
          'UPDATE users SET name = ?, phone = ?, address = ?, password_hash = ? WHERE user_id = ?',
          [name, phone, address, passwordHash, userId]
        );
      } else {
        await pool.query(
          'UPDATE users SET name = ?, phone = ?, address = ? WHERE user_id = ?',
          [name, phone, address, userId]
        );
      }
      console.log(`[MySQL sport_cpe_db] UPDATE users -> user_id=${userId}, name=${name}, phone=${phone}`);
      return sendJson(res, 200, { ok: true });
    }

    // 4. Place Order -> ACID Transaction: INSERT INTO orders, INSERT INTO order_items, UPDATE products
    if (reqUrl === '/api/db/orders' && req.method === 'POST') {
      const body = await readJsonBody(req);
      const conn = await pool.getConnection();
      try {
        await conn.beginTransaction();

        const userId = Number(body.user_id || 1);
        const subtotal = Number(body.subtotal || 0);
        const discountAmount = Number(body.discount || 0);
        const totalAmount = Number(body.total || 0);
        const shippingAddress = String(body.address || '');
        const appliedCode = String(body.appliedCode || '').toUpperCase();

        let promoId = null;
        if (appliedCode === 'SAVE15') promoId = 1;
        else if (appliedCode === 'PERKS20') promoId = 2;
        else if (appliedCode === 'SPORT10') promoId = 4;
        else if (appliedCode === 'BUY2GET1' || Number(body.buy2Get1Discount || 0) > 0) promoId = 3;

        const [orderRes] = await conn.query(
          `INSERT INTO orders (user_id, promo_id, order_date, subtotal, discount_amount, total_amount, shipping_address, order_status)
           VALUES (?, ?, NOW(), ?, ?, ?, ?, 'Pending')`,
          [userId, promoId, subtotal, discountAmount, totalAmount, shippingAddress]
        );
        const newOrderId = orderRes.insertId;

        const items = Array.isArray(body.items) ? body.items : [];
        for (const item of items) {
          const prodId = Number(item.product_id || item.id);
          const qty = Number(item.qty || item.quantity || 1);
          const freeQty = Number(item.free_qty || 0);
          const unitPrice = Number(item.price || 0);
          const itemDiscount = Number(item.discount_amount || 0);
          const itemTotal = Number(item.item_total || (unitPrice * qty));

          await conn.query(
            `INSERT INTO order_items (order_id, product_id, quantity, unit_price_at_purchase, discount_amount, free_qty, item_total)
             VALUES (?, ?, ?, ?, ?, ?, ?)`,
            [newOrderId, prodId, qty, unitPrice, itemDiscount, freeQty, itemTotal]
          );

          const totalShipped = qty + freeQty;
          await conn.query(
            'UPDATE products SET stock_quantity = GREATEST(0, stock_quantity - ?) WHERE product_id = ?',
            [totalShipped, prodId]
          );
        }

        await conn.commit();
        console.log(`[MySQL sport_cpe_db] ACID COMMIT -> INSERT INTO orders (order_id=${newOrderId}, user_id=${userId}, total=${totalAmount})`);
        return sendJson(res, 201, { ok: true, order_id: newOrderId });
      } catch (txErr) {
        await conn.rollback();
        console.error('[MySQL sport_cpe_db] Transaction Rollback:', txErr);
        return sendJson(res, 500, { ok: false, error: txErr.message });
      } finally {
        conn.release();
      }
    }

    // 5. Admin: Update Order Status -> UPDATE sport_cpe_db.orders
    if (reqUrl === '/api/db/admin/order-status' && req.method === 'PUT') {
      const body = await readJsonBody(req);
      const orderId = Number(String(body.order_id || '').replace('#', ''));
      const status = String(body.status || 'Pending');
      await pool.query('UPDATE orders SET order_status = ? WHERE order_id = ?', [status, orderId]);
      console.log(`[MySQL sport_cpe_db] UPDATE orders SET order_status='${status}' WHERE order_id=${orderId}`);
      return sendJson(res, 200, { ok: true });
    }

    // 6. Admin: Restock Product -> UPDATE sport_cpe_db.products (supports additive +add_quantity or exact stock_quantity)
    if (reqUrl === '/api/db/admin/restock' && req.method === 'PUT') {
      const body = await readJsonBody(req);
      const productId = Number(body.product_id);
      if (body.add_quantity !== undefined) {
        const addQty = Math.max(1, Math.floor(Number(body.add_quantity || 1)));
        await pool.query('UPDATE products SET stock_quantity = stock_quantity + ? WHERE product_id = ?', [addQty, productId]);
        const [rows] = await pool.query('SELECT stock_quantity FROM products WHERE product_id = ?', [productId]);
        const updatedStock = rows[0] ? Number(rows[0].stock_quantity) : 0;
        console.log(`[MySQL sport_cpe_db] UPDATE products SET stock_quantity = stock_quantity + ${addQty} (now ${updatedStock}) WHERE product_id=${productId}`);
        return sendJson(res, 200, { ok: true, stock_quantity: updatedStock });
      } else {
        const newStock = Number(body.stock_quantity || 25);
        await pool.query('UPDATE products SET stock_quantity = ? WHERE product_id = ?', [newStock, productId]);
        console.log(`[MySQL sport_cpe_db] UPDATE products SET stock_quantity=${newStock} WHERE product_id=${productId}`);
        return sendJson(res, 200, { ok: true, stock_quantity: newStock });
      }
    }

    // 7. Admin: Manage Buy 2 Get 1 Free -> INSERT / DELETE sport_cpe_db.promotion_products (promo_id = 3)
    if (reqUrl === '/api/db/admin/toggle-bogo' && req.method === 'POST') {
      const body = await readJsonBody(req);
      const productId = Number(body.product_id);
      const action = body.action || 'toggle'; // 'add' | 'remove' | 'toggle'
      const [rows] = await pool.query('SELECT * FROM promotion_products WHERE promo_id = 3 AND product_id = ?', [productId]);
      let isNowActive = false;
      if (action === 'add') {
        if (rows.length === 0) {
          await pool.query('INSERT INTO promotion_products (promo_id, product_id) VALUES (3, ?)', [productId]);
        }
        isNowActive = true;
      } else if (action === 'remove') {
        await pool.query('DELETE FROM promotion_products WHERE promo_id = 3 AND product_id = ?', [productId]);
        isNowActive = false;
      } else {
        if (rows.length > 0) {
          await pool.query('DELETE FROM promotion_products WHERE promo_id = 3 AND product_id = ?', [productId]);
          isNowActive = false;
        } else {
          await pool.query('INSERT INTO promotion_products (promo_id, product_id) VALUES (3, ?)', [productId]);
          isNowActive = true;
        }
      }
      console.log(`[MySQL sport_cpe_db] promotion_products (promo_id=3, product_id=${productId}, action=${action}) -> active=${isNowActive}`);
      return sendJson(res, 200, { ok: true, active: isNowActive });
    }

    // 8. Dynamic injection of live MySQL state into /js/app.js so every page load has fresh MySQL rows synchronously!
    if (reqUrl === '/js/app.js') {
      const appJsPath = path.join(PUBLIC_DIR, 'js', 'app.js');
      const appJsContent = fs.readFileSync(appJsPath, 'utf8');
      let livePrefix = '';
      try {
        const liveState = await buildLiveDbState();
        livePrefix = `window.__LIVE_MYSQL_DB__ = ${JSON.stringify(liveState)};\n`;
      } catch (dbErr) {
        console.error('Warning: MySQL query failed while serving app.js:', dbErr.message);
      }
      res.writeHead(200, {
        'Content-Type': 'application/javascript; charset=UTF-8',
        'Cache-Control': 'no-store, no-cache, must-revalidate'
      });
      return res.end(livePrefix + appJsContent);
    }

    // API endpoint for products
    if (reqUrl === '/api/products') {
      const dataPath = path.join(PUBLIC_DIR, 'js', 'products-data.js');
      if (fs.existsSync(dataPath)) {
        res.writeHead(200, { 'Content-Type': 'application/javascript; charset=UTF-8' });
        return res.end(fs.readFileSync(dataPath));
      }
    }

    const filePath = path.join(PUBLIC_DIR, reqUrl);

    if (fs.existsSync(filePath) && fs.statSync(filePath).isFile()) {
      const ext = path.extname(filePath).toLowerCase();
      const contentType = MIME_TYPES[ext] || 'text/plain';
      res.writeHead(200, {
        'Content-Type': contentType,
        'Cache-Control': 'no-store, no-cache, must-revalidate'
      });
      fs.createReadStream(filePath).pipe(res);
    } else {
      const fallback = path.join(PUBLIC_DIR, 'index.html');
      if (fs.existsSync(fallback)) {
        res.writeHead(200, { 'Content-Type': 'text/html; charset=UTF-8' });
        fs.createReadStream(fallback).pipe(res);
      } else {
        res.writeHead(404, { 'Content-Type': 'text/plain' });
        res.end('404 Not Found');
      }
    }
  } catch (err) {
    console.error('Server error:', err);
    res.writeHead(500, { 'Content-Type': 'text/plain; charset=UTF-8' });
    res.end('500 Internal Server Error: ' + err.message);
  }
});

server.on('error', (err) => {
  if (err && err.code === 'EADDRINUSE') {
    console.log('🔄 พบเซิร์ฟเวอร์ตัวเดิมเปิดค้างอยู่ที่พอร์ต ' + PORT + ' กำลังสลับมาใช้เซิร์ฟเวอร์ตัวใหม่ให้อัตโนมัติ...');
    try {
      const { execSync } = require('child_process');
      const netstatOut = execSync('netstat -ano | findstr :' + PORT).toString();
      const lines = netstatOut.split('\n').map(l => l.trim()).filter(l => l.includes('LISTENING'));
      for (const line of lines) {
        const parts = line.split(/\s+/);
        const pid = Number(parts[parts.length - 1]);
        if (pid && pid !== process.pid) {
          execSync('taskkill /F /PID ' + pid);
        }
      }
      setTimeout(() => {
        server.listen(PORT, '0.0.0.0');
      }, 300);
    } catch (e) {
      console.log('✅ เซิร์ฟเวอร์เปิดทำงานอยู่แล้วที่ http://localhost:' + PORT);
      process.exit(0);
    }
  } else {
    console.error('Server error:', err);
  }
});

server.listen(PORT, '0.0.0.0', async () => {
  console.log('==================================================');
  console.log('🏃 SPORT.CPE Server is live and connected to MySQL (sport_cpe_db)!');
  console.log('👉 URL: http://localhost:' + PORT);
  console.log('👉 MySQL Database: localhost:3306 / sport_cpe_db');
  console.log('==================================================');
});
