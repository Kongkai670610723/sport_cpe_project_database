// SPORT.CPE — Relational Database State Engine (100% Synced with database/schema.sql)

// Table 2: users (6 Seed Users from schema.sql)
const SEED_USERS_TABLE = [
  {
    user_id: 1,
    name: 'Kongkai Jai-dee',
    email: 'kongkai@cpe.eng.cmu.ac.th',
    password: 'password123',
    phone: '089-123-4567',
    address: 'ภาควิชาวิศวกรรมคอมพิวเตอร์ คณะวิศวกรรมศาสตร์ มช. 50200',
    role: 'customer',
    member_since: 'Oct 2026'
  },
  {
    user_id: 2,
    name: 'Admin SportCPE',
    email: 'admin@sportcpe.com',
    alt_email: 'admin@cpe.eng.cmu.ac.th',
    password: 'password123',
    phone: '053-942-023',
    address: 'สำนักงาน SPORT.CPE อาคาร 30 ปี คณะวิศวกรรมศาสตร์ มช. 50200',
    role: 'admin',
    member_since: 'Oct 2026'
  },
  {
    user_id: 3,
    name: 'Somsak Rattanakul',
    email: 'somsak.r@gmail.com',
    password: 'password123',
    phone: '081-456-7890',
    address: '128/4 ถ.ห้วยแก้ว ต.สุเทพ อ.เมือง จ.เชียงใหม่ 50200',
    role: 'customer',
    member_since: 'Oct 2026'
  },
  {
    user_id: 4,
    name: 'Arisa Wongsuwan',
    email: 'arisa.w@outlook.com',
    password: 'password123',
    phone: '086-789-1234',
    address: '45/2 หมู่ 5 ถ.นิมมานเหมินท์ ต.สุเทพ อ.เมือง จ.เชียงใหม่ 50200',
    role: 'customer',
    member_since: 'Oct 2026'
  },
  {
    user_id: 5,
    name: 'Thanawat Siriwat',
    email: 'thanawat.s@cmu.ac.th',
    password: 'password123',
    phone: '092-345-6789',
    address: 'หอพักนักศึกษาชาย อาคาร 4 มหาวิทยาลัยเชียงใหม่ 50200',
    role: 'customer',
    member_since: 'Oct 2026'
  },
  {
    user_id: 6,
    name: 'Ploypailin Chaisri',
    email: 'ploypailin.c@yahoo.com',
    password: 'password123',
    phone: '084-567-8901',
    address: '89 ถ.คลองชลประทาน ต.สุเทพ อ.เมือง จ.เชียงใหม่ 50200',
    role: 'customer',
    member_since: 'Oct 2026'
  }
];

// Table 3: promotions (100% synced with sport_cpe_db.promotions rows 1-4)
const PROMO_CATALOG = {
  'SAVE15': { promo_id: 1, code: 'SAVE15', name: 'คูปองส่วนลดพิเศษ 15%', type: 'PERCENT', percent: 15, minSpend: 1000, label: 'SAVE15 (-15%)' },
  'PERKS20': { promo_id: 2, code: 'PERKS20', name: 'คูปองสิทธิพิเศษนักกีฬา 20%', type: 'PERCENT', percent: 20, minSpend: 2000, label: 'PERKS20 (-20%)' },
  'BUY2GET1': { promo_id: 3, code: 'BUY2GET1', name: 'โปรโมชันซื้อ 2 แถม 1 อัตโนมัติ (เฉพาะรุ่นที่ร่วมรายการ)', type: 'BUY_X_GET_Y', buy_qty: 2, get_qty: 1, percent: 0, minSpend: 0, label: 'BUY2GET1' },
  'SPORT10': { promo_id: 4, code: 'SPORT10', name: 'คูปองส่วนลดต้อนรับสมาชิก 10%', type: 'PERCENT', percent: 10, minSpend: 500, label: 'SPORT10 (-10%)' }
};

// Table 5: promotion_products (Exact M:N Junction rows for promo_id = 3 BUY2GET1 from schema.sql lines 335-343)
// Product IDs: 17, 18, 19, 20, 21, 22, 23, 24, 34
const SEED_BUY2GET1_PRODUCT_IDS = [17, 18, 19, 20, 21, 22, 23, 24, 34];

// Table 6 & 7: orders (12 rows) & order_items (20 rows) from schema.sql lines 346-381
const SEED_ORDERS_TABLE = [
  {
    order_id: 1012,
    id: '#1012',
    user_id: 3,
    customer: 'Somsak Rattanakul',
    promo_id: null,
    discountCode: 'ไม่มี',
    date: 'Oct 31, 2026',
    subtotal: 4200,
    discount: 0,
    total: 4200,
    address: '128/4 ถ.ห้วยแก้ว ต.สุเทพ อ.เมือง จ.เชียงใหม่ 50200',
    status: 'Cancelled',
    payment: 'PromptPay QR Code / Mobile Banking',
    tracking: 'ยกเลิกคำสั่งซื้อตามคำขอของลูกค้า',
    items: [
      { product_id: 102, name: 'Helinox Chair One Ultralight Camp Chair', brand: 'Helinox', category: 'Camping', qty: 1, free_qty: 0, price: 4200, discount_amount: 0, item_total: 4200 }
    ]
  },
  {
    order_id: 1011,
    id: '#1011',
    user_id: 1,
    customer: 'Kongkai Jai-dee',
    promo_id: 1,
    discountCode: 'SAVE15 (-15%)',
    date: 'Oct 30, 2026',
    subtotal: 8900,
    discount: 1335,
    total: 7565,
    address: 'ภาควิชาวิศวกรรมคอมพิวเตอร์ คณะวิศวกรรมศาสตร์ มช. 50200',
    status: 'Pending',
    payment: 'PromptPay QR Code / Mobile Banking',
    tracking: 'รอจัดส่งพัสดุ (กำลังเตรียมสินค้าจากคลัง SPORT.CPE)',
    items: [
      { product_id: 11, name: 'Coros Pace 3 Sports Watch', brand: 'Coros', category: 'Running', qty: 1, free_qty: 0, price: 8900, discount_amount: 1335, item_total: 7565 }
    ]
  },
  {
    order_id: 1010,
    id: '#1010',
    user_id: 6,
    customer: 'Ploypailin Chaisri',
    promo_id: null,
    discountCode: 'ไม่มี',
    date: 'Oct 29, 2026',
    subtotal: 6430,
    discount: 0,
    total: 6430,
    address: '89 ถ.คลองชลประทาน ต.สุเทพ อ.เมือง จ.เชียงใหม่ 50200',
    status: 'Pending',
    payment: 'Credit / Debit Card (Visa / Mastercard)',
    tracking: 'รอจัดส่งพัสดุ (กำลังเตรียมสินค้าจากคลัง SPORT.CPE)',
    items: [
      { product_id: 84, name: 'Manduka PRO Yoga Mat (6mm)', brand: 'Manduka', category: 'Fitness', qty: 1, free_qty: 0, price: 4980, discount_amount: 0, item_total: 4980 },
      { product_id: 87, name: 'Gymreapers Heavy Duty Lifting Straps', brand: 'Gymreapers', category: 'Fitness', qty: 1, free_qty: 0, price: 1450, discount_amount: 0, item_total: 1450 }
    ]
  },
  {
    order_id: 1009,
    id: '#1009',
    user_id: 5,
    customer: 'Thanawat Siriwat',
    promo_id: null,
    discountCode: 'ไม่มี',
    date: 'Oct 28, 2026',
    subtotal: 4300,
    discount: 0,
    total: 4300,
    address: 'หอพักนักศึกษาชาย อาคาร 4 มหาวิทยาลัยเชียงใหม่ 50200',
    status: 'Paid',
    payment: 'PromptPay QR Code / Mobile Banking',
    tracking: 'ชำระเงินสำเร็จ อยู่ระหว่างแพ็กสินค้า',
    items: [
      { product_id: 42, name: 'Spalding Heavy Duty Basketball Net', brand: 'Spalding', category: 'Basketball', qty: 1, free_qty: 0, price: 390, discount_amount: 0, item_total: 390 },
      { product_id: 44, name: 'McDavid Hex Knee Pads (Pair)', brand: 'McDavid', category: 'Basketball', qty: 2, free_qty: 0, price: 1690, discount_amount: 0, item_total: 3380 },
      { product_id: 47, name: 'Shock Doctor Gel Max Mouthguard', brand: 'Shock Doctor', category: 'Basketball', qty: 1, free_qty: 0, price: 530, discount_amount: 0, item_total: 530 }
    ]
  },
  {
    order_id: 1008,
    id: '#1008',
    user_id: 4,
    customer: 'Arisa Wongsuwan',
    promo_id: 2,
    discountCode: 'PERKS20 (-20%)',
    date: 'Oct 27, 2026',
    subtotal: 7850,
    discount: 1570,
    total: 6280,
    address: '45/2 หมู่ 5 ถ.นิมมานเหมินท์ ต.สุเทพ อ.เมือง จ.เชียงใหม่ 50200',
    status: 'Paid',
    payment: 'Credit / Debit Card (Visa / Mastercard)',
    tracking: 'ชำระเงินสำเร็จ เตรียมส่งมอบขนส่ง Kerry Express',
    items: [
      { product_id: 114, name: 'Mikasa V200W Official Game Ball (FIVB)', brand: 'Mikasa', category: 'Volleyball', qty: 1, free_qty: 0, price: 2350, discount_amount: 470, item_total: 1880 },
      { product_id: 116, name: 'Asics Sky Elite FF 2 Volleyball Shoes', brand: 'Asics', category: 'Volleyball', qty: 1, free_qty: 0, price: 5500, discount_amount: 1100, item_total: 4400 }
    ]
  },
  {
    order_id: 1007,
    id: '#1007',
    user_id: 3,
    customer: 'Somsak Rattanakul',
    promo_id: 1,
    discountCode: 'SAVE15 (-15%)',
    date: 'Oct 26, 2026',
    subtotal: 8190,
    discount: 1228.50,
    total: 6961.50,
    address: '128/4 ถ.ห้วยแก้ว ต.สุเทพ อ.เมือง จ.เชียงใหม่ 50200',
    status: 'Paid',
    payment: 'PromptPay QR Code / Mobile Banking',
    tracking: 'ชำระเงินสำเร็จ เตรียมจัดส่ง',
    items: [
      { product_id: 97, name: 'Quechua 2-Seconds Easy Tent (3-Person)', brand: 'Quechua', category: 'Camping', qty: 1, free_qty: 0, price: 4990, discount_amount: 748.50, item_total: 4241.50 },
      { product_id: 100, name: 'Naturehike Goose Down Sleeping Bag (-5C)', brand: 'Naturehike', category: 'Camping', qty: 1, free_qty: 0, price: 3200, discount_amount: 480, item_total: 2720 }
    ]
  },
  {
    order_id: 1006,
    id: '#1006',
    user_id: 1,
    customer: 'Kongkai Jai-dee',
    promo_id: null,
    discountCode: 'FREESHIP',
    date: 'Oct 24, 2026',
    subtotal: 4500,
    discount: 0,
    total: 4500,
    address: 'ภาควิชาวิศวกรรมคอมพิวเตอร์ คณะวิศวกรรมศาสตร์ มช. 50200',
    status: 'Shipped',
    payment: 'Credit / Debit Card (Visa / Mastercard)',
    tracking: 'Kerry Express: KEX-904827164TH (อยู่ระหว่างขนส่งไปเชียงใหม่)',
    items: [
      { product_id: 53, name: 'Adidas Conext 24 Pro Match Ball', brand: 'Adidas', category: 'Football', qty: 1, free_qty: 0, price: 4500, discount_amount: 0, item_total: 4500 }
    ]
  },
  {
    order_id: 1005,
    id: '#1005',
    user_id: 6,
    customer: 'Ploypailin Chaisri',
    promo_id: 1,
    discountCode: 'SAVE15 (-15%)',
    date: 'Oct 22, 2026',
    subtotal: 12900,
    discount: 1935,
    total: 10965,
    address: '89 ถ.คลองชลประทาน ต.สุเทพ อ.เมือง จ.เชียงใหม่ 50200',
    status: 'Shipped',
    payment: 'PromptPay QR Code / Mobile Banking',
    tracking: 'Flash Express: TH4401928374B (กำลังนำจ่าย)',
    items: [
      { product_id: 81, name: 'Bowflex SelectTech 552 Adjustable Dumbbells', brand: 'Bowflex', category: 'Fitness', qty: 1, free_qty: 0, price: 12900, discount_amount: 1935, item_total: 10965 }
    ]
  },
  {
    order_id: 1004,
    id: '#1004',
    user_id: 5,
    customer: 'Thanawat Siriwat',
    promo_id: 3,
    discountCode: 'BUY2GET1 (ซื้อ 2 แถม 1)',
    date: 'Oct 20, 2026',
    subtotal: 7350,
    discount: 2450,
    total: 4900,
    address: 'หอพักนักศึกษาชาย อาคาร 4 มหาวิทยาลัยเชียงใหม่ 50200',
    status: 'Shipped',
    payment: 'PromptPay QR Code / Mobile Banking',
    tracking: 'Kerry Express: KEX-883716253TH',
    items: [
      { product_id: 34, name: 'Molten BG4500 FIBA Basketball (Size 7)', brand: 'Molten', category: 'Basketball', qty: 3, free_qty: 1, price: 2450, discount_amount: 2450, item_total: 4900 }
    ]
  },
  {
    order_id: 1003,
    id: '#1003',
    user_id: 4,
    customer: 'Arisa Wongsuwan',
    promo_id: null,
    discountCode: 'ไม่มี',
    date: 'Oct 18, 2026',
    subtotal: 3780,
    discount: 0,
    total: 3780,
    address: '45/2 หมู่ 5 ถ.นิมมานเหมินท์ ต.สุเทพ อ.เมือง จ.เชียงใหม่ 50200',
    status: 'Delivered',
    payment: 'Cash on Delivery (COD)',
    tracking: 'จัดส่งสำเร็จ เซ็นรับแล้ว',
    items: [
      { product_id: 66, name: 'Arena Cobra Ultra Swipe Mirror Goggles', brand: 'Arena', category: 'Swim', qty: 1, free_qty: 0, price: 2790, discount_amount: 0, item_total: 2790 },
      { product_id: 75, name: 'Speedo Pullbuoy Kickboard Combo', brand: 'Speedo', category: 'Swim', qty: 1, free_qty: 0, price: 990, discount_amount: 0, item_total: 990 }
    ]
  },
  {
    order_id: 1002,
    id: '#1002',
    user_id: 3,
    customer: 'Somsak Rattanakul',
    promo_id: 2,
    discountCode: 'PERKS20 (-20%)',
    date: 'Oct 17, 2026',
    subtotal: 9500,
    discount: 1900,
    total: 7600,
    address: '128/4 ถ.ห้วยแก้ว ต.สุเทพ อ.เมือง จ.เชียงใหม่ 50200',
    status: 'Delivered',
    payment: 'Credit / Debit Card (Visa / Mastercard)',
    tracking: 'จัดส่งสำเร็จ เซ็นรับแล้ว',
    items: [
      { product_id: 1, name: 'Nike Air Zoom Pegasus 40', brand: 'Nike', category: 'Running', qty: 1, free_qty: 0, price: 4600, discount_amount: 920, item_total: 3680 },
      { product_id: 5, name: 'Asics Novablast 4', brand: 'Asics', category: 'Running', qty: 1, free_qty: 0, price: 4900, discount_amount: 980, item_total: 3920 }
    ]
  },
  {
    order_id: 1001,
    id: '#1001',
    user_id: 1,
    customer: 'Kongkai Jai-dee',
    promo_id: 1,
    discountCode: 'SAVE15 (-15%)',
    date: 'Oct 15, 2026',
    subtotal: 11500,
    discount: 1725,
    total: 9775,
    address: 'ภาควิชาวิศวกรรมคอมพิวเตอร์ คณะวิศวกรรมศาสตร์ มช. 50200',
    status: 'Delivered',
    payment: 'PromptPay QR Code / Mobile Banking',
    tracking: 'Flash Express: TH0192837465A (จัดส่งสำเร็จ เซ็นรับแล้ว)',
    items: [
      { product_id: 17, name: 'Yonex Astrox 99 Pro Racket', brand: 'Yonex', category: 'Badminton', qty: 1, free_qty: 0, price: 6900, discount_amount: 1035, item_total: 5865 },
      { product_id: 23, name: 'Yonex Aerosensa 50 Shuttlecocks (12 pcs)', brand: 'Yonex', category: 'Badminton', qty: 4, free_qty: 0, price: 1150, discount_amount: 690, item_total: 3910 }
    ]
  }
];

const STATE = {
  // ---------------- USERS & AUTHENTICATION (Table: users in sport_cpe_db) ----------------
  getUsers() {
    if (typeof window !== 'undefined' && window.__LIVE_MYSQL_DB__ && Array.isArray(window.__LIVE_MYSQL_DB__.users)) {
      return window.__LIVE_MYSQL_DB__.users;
    }
    const raw = localStorage.getItem('sport_cpe_users_db_v3');
    if (!raw) {
      let merged = [...SEED_USERS_TABLE];
      localStorage.setItem('sport_cpe_users_db_v3', JSON.stringify(merged));
      return merged;
    }
    return JSON.parse(raw);
  },
  saveUsers(users) {
    if (typeof window !== 'undefined' && window.__LIVE_MYSQL_DB__) {
      window.__LIVE_MYSQL_DB__.users = users;
    }
    localStorage.setItem('sport_cpe_users_db_v3', JSON.stringify(users));
  },
  getCurrentUser() {
    const raw = localStorage.getItem('sport_cpe_current_user');
    if (!raw) return null;
    try {
      const u = JSON.parse(raw);
      // Ensure user_id is always synced with users table
      const dbUser = this.getUsers().find(x =>
        x.email.toLowerCase() === String(u.email || '').toLowerCase() ||
        (x.alt_email && x.alt_email.toLowerCase() === String(u.email || '').toLowerCase())
      );
      return dbUser || u;
    } catch (e) {
      return null;
    }
  },
  setCurrentUser(user) {
    if (!user) {
      localStorage.removeItem('sport_cpe_current_user');
    } else {
      localStorage.setItem('sport_cpe_current_user', JSON.stringify(user));
    }
    this.updateHeaderUI();
  },
  logout() {
    localStorage.removeItem('sport_cpe_current_user');
    this.updateHeaderUI();
    window.location.href = 'index.html';
  },
  isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(String(email || '').trim());
  },
  isValidPhone(phone) {
    const digitsOnly = String(phone || '').replace(/[-\s]/g, '').trim();
    return /^0[0-9]{9}$/.test(digitsOnly);
  },
  requireLoginModal(actionDesc = 'เพิ่มสินค้าหรือเข้าใช้งานตะกร้าสินค้า') {
    let existing = document.getElementById('sport-cpe-auth-modal');
    if (existing) existing.remove();

    const modal = document.createElement('div');
    modal.id = 'sport-cpe-auth-modal';
    modal.className = 'fixed inset-0 z-50 bg-slate-900/60 backdrop-blur-xs flex items-center justify-center p-4';
    modal.innerHTML = `
      <div class="bg-white rounded-3xl max-w-md w-full p-7 border border-slate-200 shadow-2xl text-center animate-fade-in">
        <div class="w-14 h-14 rounded-full bg-orange-100 text-[#ff6b00] text-2xl flex items-center justify-center mx-auto mb-4 shadow-xs">
          🔒
        </div>
        <h3 class="text-xl font-black text-slate-900 mb-2">กรุณาเข้าสู่ระบบสมาชิก</h3>
        <p class="text-xs text-slate-600 leading-relaxed mb-6">
          คุณต้องทำการ <strong>เข้าสู่ระบบ (Log in)</strong> หรือสมัครสมาชิกก่อน จึงจะสามารถ<strong>${actionDesc}</strong>ได้ เพื่อใช้บันทึกข้อมูลของคุณลงในฐานข้อมูลระบบ
        </p>
        <div class="space-y-2.5 text-xs">
          <a href="login.html?auth_required=1" class="w-full bg-[#0b1329] hover:bg-slate-800 text-white font-bold py-3 rounded-xl flex items-center justify-center gap-1.5 shadow-md transition">
            <span>👤 ไปหน้าเข้าสู่ระบบ (Log in) →</span>
          </a>
          <a href="register.html" class="w-full bg-[#ff6b00] hover:bg-orange-600 text-white font-bold py-3 rounded-xl flex items-center justify-center gap-1.5 shadow-sm transition">
            <span>✨ สมัครสมาชิกใหม่ (Create Account)</span>
          </a>
          <button type="button" onclick="const m=document.getElementById('sport-cpe-auth-modal'); if(m) m.remove();" class="w-full border border-slate-300 hover:bg-slate-100 text-slate-600 font-semibold py-2.5 rounded-xl transition mt-1">
            ไว้ทีหลัง (ดูสินค้าต่อ)
          </button>
        </div>
      </div>
    `;
    document.body.appendChild(modal);
  },
  getInitials(name) {
    if (!name) return 'MB';
    const parts = name.trim().split(/\s+/);
    if (parts.length >= 2) {
      return (parts[0][0] + parts[1][0]).toUpperCase();
    }
    return name.slice(0, 2).toUpperCase();
  },

  // ---------------- PROMOTION_PRODUCTS TABLE (promo_id = 3 BUY2GET1 in sport_cpe_db) ----------------
  getBuy2Get1ProductIds() {
    if (typeof window !== 'undefined' && window.__LIVE_MYSQL_DB__ && Array.isArray(window.__LIVE_MYSQL_DB__.buy2get1Ids)) {
      return window.__LIVE_MYSQL_DB__.buy2get1Ids;
    }
    const raw = localStorage.getItem('sport_cpe_buy2get1_ids');
    if (!raw) {
      localStorage.setItem('sport_cpe_buy2get1_ids', JSON.stringify(SEED_BUY2GET1_PRODUCT_IDS));
      return SEED_BUY2GET1_PRODUCT_IDS;
    }
    try {
      return JSON.parse(raw);
    } catch (e) {
      return SEED_BUY2GET1_PRODUCT_IDS;
    }
  },
  saveBuy2Get1ProductIds(ids) {
    if (typeof window !== 'undefined' && window.__LIVE_MYSQL_DB__) {
      window.__LIVE_MYSQL_DB__.buy2get1Ids = ids;
    }
    localStorage.setItem('sport_cpe_buy2get1_ids', JSON.stringify(ids));
  },
  isBuy2Get1Eligible(productId) {
    return this.getBuy2Get1ProductIds().includes(Number(productId));
  },
  toggleBuy2Get1Product(productId) {
    const idNum = Number(productId);
    let ids = [...this.getBuy2Get1ProductIds()];
    const exists = ids.includes(idNum);
    if (exists) {
      ids = ids.filter(x => x !== idNum);
    } else {
      ids.push(idNum);
      ids.sort((a, b) => a - b);
    }
    this.saveBuy2Get1ProductIds(ids);
    if (typeof fetch === 'function') {
      fetch('/api/db/admin/toggle-bogo', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ product_id: idNum, action: exists ? 'remove' : 'add' })
      }).catch(() => {});
    }
    return !exists;
  },
  addBuy2Get1Product(productId) {
    const idNum = Number(productId);
    let ids = [...this.getBuy2Get1ProductIds()];
    if (!ids.includes(idNum)) {
      ids.push(idNum);
      ids.sort((a, b) => a - b);
      this.saveBuy2Get1ProductIds(ids);
    }
    if (typeof fetch === 'function') {
      fetch('/api/db/admin/toggle-bogo', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ product_id: idNum, action: 'add' })
      }).catch(() => {});
    }
    return true;
  },
  removeBuy2Get1Product(productId) {
    const idNum = Number(productId);
    let ids = this.getBuy2Get1ProductIds().filter(x => x !== idNum);
    this.saveBuy2Get1ProductIds(ids);
    if (typeof fetch === 'function') {
      fetch('/api/db/admin/toggle-bogo', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ product_id: idNum, action: 'remove' })
      }).catch(() => {});
    }
    return false;
  },

  // ---------------- PRODUCTS STOCK MANAGEMENT (Table: products in sport_cpe_db) ----------------
  getStockOverrides() {
    const raw = localStorage.getItem('sport_cpe_stock_overrides');
    return raw ? JSON.parse(raw) : {};
  },
  getProductStock(productId) {
    if (typeof window !== 'undefined' && window.__LIVE_MYSQL_DB__ && window.__LIVE_MYSQL_DB__.stockMap && window.__LIVE_MYSQL_DB__.stockMap[productId] !== undefined) {
      return Number(window.__LIVE_MYSQL_DB__.stockMap[productId]);
    }
    const overrides = this.getStockOverrides();
    if (overrides[productId] !== undefined) return overrides[productId];
    const p = (typeof PRODUCTS_DB !== 'undefined') ? PRODUCTS_DB.find(x => x.id === Number(productId)) : null;
    return p ? p.stock : 15;
  },
  setProductStock(productId, newStock) {
    const cleanStock = Math.max(0, Number(newStock));
    if (typeof window !== 'undefined' && window.__LIVE_MYSQL_DB__ && window.__LIVE_MYSQL_DB__.stockMap) {
      window.__LIVE_MYSQL_DB__.stockMap[productId] = cleanStock;
    }
    const overrides = this.getStockOverrides();
    overrides[productId] = cleanStock;
    localStorage.setItem('sport_cpe_stock_overrides', JSON.stringify(overrides));
  },

  // ---------------- CART & PER-ITEM BUY2GET1 ENGINE ----------------
  _getCartStorageKey() {
    const u = this.getCurrentUser();
    if (!u) return null;
    return 'sport_cpe_cart_user_' + (u.user_id || String(u.email).toLowerCase());
  },
  getCart() {
    const key = this._getCartStorageKey();
    if (!key) {
      return [];
    }
    const raw = localStorage.getItem(key);
    if (!raw) {
      return [];
    }
    try {
      const parsed = JSON.parse(raw);
      return parsed.map(item => {
        const dbProd = (typeof PRODUCTS_DB !== 'undefined') ? PRODUCTS_DB.find(p => p.id === item.id) : null;
        return {
          ...item,
          category: dbProd ? dbProd.category_en : (item.category || 'Sports'),
          image: dbProd ? dbProd.image : item.image,
          promo_eligible: this.isBuy2Get1Eligible(item.id)
        };
      });
    } catch (e) {
      return [];
    }
  },
  saveCart(cart) {
    const key = this._getCartStorageKey();
    if (key) {
      localStorage.setItem(key, JSON.stringify(cart));
    }
    this.updateCartBadge();
  },
  addToCart(productId, qty = 1, silent = false) {
    if (!this.getCurrentUser()) {
      this.requireLoginModal('เพิ่มสินค้าลงตะกร้า หรือสั่งซื้อสินค้า');
      return false;
    }
    const cart = this.getCart();
    const p = (typeof PRODUCTS_DB !== 'undefined') ? PRODUCTS_DB.find(x => x.id === Number(productId)) : null;
    const item = cart.find(x => x.id === Number(productId));
    if (item) {
      item.quantity += qty;
    } else if (p) {
      cart.push({
        id: p.id,
        name: p.name,
        brand: p.brand,
        category: p.category_en || 'Badminton',
        price: p.price,
        quantity: qty,
        image: p.image
      });
    }
    this.saveCart(cart);
    if (!silent) {
      this.showToast('เพิ่ม "' + (p ? p.name : 'สินค้า') + '" (จำนวน ' + qty + ' ชิ้น) ลงในตะกร้าแล้ว!');
    }
    return true;
  },
  updateCartQty(productId, delta) {
    let cart = this.getCart();
    const idx = cart.findIndex(x => x.id === Number(productId));
    if (idx !== -1) {
      cart[idx].quantity += delta;
      if (cart[idx].quantity <= 0) {
        cart.splice(idx, 1);
      }
      this.saveCart(cart);
    }
    return cart;
  },
  removeFromCart(productId) {
    let cart = this.getCart().filter(x => x.id !== Number(productId));
    this.saveCart(cart);
    return cart;
  },
  getAppliedPromo() {
    const val = localStorage.getItem('sport_cpe_applied_promo') || '';
    if (val === 'FREESHIP') {
      localStorage.setItem('sport_cpe_applied_promo', 'SPORT10');
      return 'SPORT10';
    }
    return val;
  },
  setAppliedPromo(code) {
    if (!code) {
      localStorage.removeItem('sport_cpe_applied_promo');
    } else {
      localStorage.setItem('sport_cpe_applied_promo', code.toUpperCase().trim());
    }
  },

  // Fix #1: Per-Product Individual Buy 2 Get 1 Free Calculation (Auto-Free Gift on buying every 2 units!)
  // Only products in promotion_products (promo_id = 3) are eligible.
  // When a customer buys >= 2 units of an eligible product, every 2 purchased units automatically grants
  // +1 FREE unit (free_qty = Math.floor(qty / 2)), so the customer receives (qty + free_qty) units total!
  calculateCartSummary() {
    const rawCart = this.getCart();
    let totalItems = 0;
    let totalReceivedItems = 0;
    let subtotal = 0;
    let paidSubtotal = 0;
    let buy2Get1Discount = 0;
    let totalFreeUnits = 0;

    const cart = rawCart.map(item => {
      const isEligible = this.isBuy2Get1Eligible(item.id);
      const freeQty = isEligible ? Math.floor(item.quantity / 2) : 0;
      const totalReceivedQty = item.quantity + freeQty;
      const itemPromoDiscount = freeQty * item.price;
      const lineNetTotal = item.price * item.quantity;
      const lineSubtotal = lineNetTotal + itemPromoDiscount;

      totalItems += item.quantity;
      totalReceivedItems += totalReceivedQty;
      subtotal += lineSubtotal;
      paidSubtotal += lineNetTotal;
      buy2Get1Discount += itemPromoDiscount;
      totalFreeUnits += freeQty;

      return {
        ...item,
        promo_eligible: isEligible,
        free_qty: freeQty,
        total_received_qty: totalReceivedQty,
        item_discount: itemPromoDiscount,
        line_subtotal: lineSubtotal,
        line_net_total: lineNetTotal
      };
    });

    // Check user-applied promo code
    const appliedCode = this.getAppliedPromo();
    const collectedVouchers = this.getVouchers();
    let codeDiscount = 0;
    let promoLabel = '';
    let promoError = '';

    if (appliedCode && PROMO_CATALOG[appliedCode]) {
      const promo = PROMO_CATALOG[appliedCode];
      if (promo.type !== 'BUY_X_GET_Y' && !collectedVouchers.includes(appliedCode)) {
        promoError = 'คุณยังไม่ได้เก็บโค้ด ' + appliedCode + ' (กรุณาไปกดเก็บโค้ดที่หน้าคูปองส่วนลดก่อนใช้งาน)';
      } else if (paidSubtotal < promo.minSpend) {
        promoError = 'โค้ด ' + appliedCode + ' ต้องมียอดสั่งซื้อขั้นต่ำ ฿' + promo.minSpend.toLocaleString();
      } else if (promo.type === 'PERCENT') {
        codeDiscount = Math.round(paidSubtotal * (promo.percent / 100));
        promoLabel = appliedCode + ' (-' + promo.percent + '%)';
      } else if (promo.type === 'FREESHIP') {
        promoLabel = 'FREESHIP';
      } else if (promo.type === 'BUY_X_GET_Y') {
        if (buy2Get1Discount === 0) {
          promoError = 'โปรโมชัน BUY2GET1 ต้องซื้อสินค้าชิ้นเดียวกันที่ร่วมรายการ (มีป้ายสีเขียว Buy 2 Get 1 Free) ครบ 2 ชิ้นขึ้นไป ระบบจะแถมฟรีให้ 1 ชิ้นอัตโนมัติ';
        } else {
          promoLabel = 'BUY2GET1';
        }
      }
    }

    // Combine or select active discount
    let totalDiscount = 0;
    let discountTitle = 'Discount';
    if (buy2Get1Discount > 0 && codeDiscount > 0 && appliedCode !== 'BUY2GET1') {
      totalDiscount = buy2Get1Discount + codeDiscount;
      discountTitle = 'Discount (BUY2GET1 แถมฟรี ' + totalFreeUnits + ' ชิ้น + ' + appliedCode + ')';
    } else if (codeDiscount > 0) {
      totalDiscount = codeDiscount;
      discountTitle = 'Discount (' + promoLabel + ')';
    } else if (buy2Get1Discount > 0) {
      totalDiscount = buy2Get1Discount;
      discountTitle = 'Discount (BUY2GET1: แถมฟรี ' + totalFreeUnits + ' ชิ้น)';
    } else if (appliedCode === 'FREESHIP' && !promoError) {
      discountTitle = 'Discount (FREESHIP)';
    }

    const netTotal = Math.max(0, subtotal - totalDiscount);
    return {
      cart,
      totalItems,
      totalReceivedItems,
      totalFreeUnits,
      subtotal,
      paidSubtotal,
      buy2Get1Discount,
      codeDiscount,
      totalDiscount,
      discountTitle,
      appliedCode,
      promoError,
      deliveryFee: 'Free',
      netTotal
    };
  },

  // ---------------- VOUCHERS (SINGLE-CLAIM LOCK PER USER) ----------------
  _getVoucherStorageKey() {
    const u = this.getCurrentUser();
    return u ? ('sport_cpe_vouchers_user_' + u.user_id) : null;
  },
  getVouchers() {
    const key = this._getVoucherStorageKey();
    if (!key) return [];
    const raw = localStorage.getItem(key);
    let list = raw ? JSON.parse(raw) : [];
    if (list.includes('FREESHIP')) {
      list = list.map(c => c === 'FREESHIP' ? 'SPORT10' : c);
      list = Array.from(new Set(list));
      localStorage.setItem(key, JSON.stringify(list));
    }
    return list;
  },
  claimVoucher(code) {
    if (!this.getCurrentUser()) {
      this.requireLoginModal('กดเก็บโค้ดส่วนลดไว้ในบัญชีของคุณ');
      return false;
    }
    const v = this.getVouchers();
    if (v.includes(code)) {
      this.showToast('โค้ด ' + code + ' ถูกเก็บไว้แล้ว ไม่สามารถกดรับซ้ำได้', 'warn');
      return false;
    }
    v.push(code);
    localStorage.setItem(this._getVoucherStorageKey(), JSON.stringify(v));
    this.showToast('เก็บโค้ดส่วนลด ' + code + ' สำเร็จ! นำไปใช้ในหน้าตะกร้าได้เลย');
    if (typeof window.syncVoucherButtonsUI === 'function') {
      window.syncVoucherButtonsUI();
    }
    return true;
  },
  claimAllVouchers() {
    if (!this.getCurrentUser()) {
      this.requireLoginModal('กดเก็บโค้ดส่วนลดทั้งหมดไว้ในบัญชีของคุณ');
      return false;
    }
    const allCodes = ['SAVE15', 'PERKS20', 'SPORT10'];
    const current = this.getVouchers();
    const uncollected = allCodes.filter(c => !current.includes(c));
    if (uncollected.length === 0) {
      this.showToast('คุณเก็บโค้ดส่วนลดครบทุกใบแล้ว ไม่สามารถกดรับซ้ำได้', 'warn');
      return false;
    }
    localStorage.setItem(this._getVoucherStorageKey(), JSON.stringify(allCodes));
    this.showToast('เก็บโค้ดส่วนลดทั้งหมด (' + uncollected.join(', ') + ') เรียบร้อยแล้ว!');
    if (typeof window.syncVoucherButtonsUI === 'function') {
      window.syncVoucherButtonsUI();
    }
    return true;
  },

  // ---------------- ORDERS & ORDER_ITEMS (Relational by user_id in sport_cpe_db) ----------------
  getAllOrders() {
    if (typeof window !== 'undefined' && window.__LIVE_MYSQL_DB__ && Array.isArray(window.__LIVE_MYSQL_DB__.orders)) {
      return window.__LIVE_MYSQL_DB__.orders;
    }
    const raw = localStorage.getItem('sport_cpe_orders_db_v3');
    if (!raw) {
      localStorage.setItem('sport_cpe_orders_db_v3', JSON.stringify(SEED_ORDERS_TABLE));
      return SEED_ORDERS_TABLE;
    }
    try {
      return JSON.parse(raw);
    } catch (e) {
      return SEED_ORDERS_TABLE;
    }
  },
  saveAllOrders(orders) {
    if (typeof window !== 'undefined' && window.__LIVE_MYSQL_DB__) {
      window.__LIVE_MYSQL_DB__.orders = orders;
    }
    localStorage.setItem('sport_cpe_orders_db_v3', JSON.stringify(orders));
  },
  // Fix #3: Query orders strictly belonging to the logged-in user (SELECT * FROM orders WHERE user_id = ?)
  getOrdersByUser(user) {
    if (!user) return [];
    const allOrders = this.getAllOrders();
    return allOrders.filter(o =>
      (user.user_id && Number(o.user_id) === Number(user.user_id)) ||
      (o.user_email && String(o.user_email).toLowerCase() === String(user.email).toLowerCase())
    );
  },
  // Backwards-compatible alias for Admin table
  getOrders() {
    return this.getAllOrders();
  },
  addProductStock(productId, addQty, name) {
    const idNum = Number(productId);
    const delta = Math.max(1, Math.floor(Number(addQty) || 1));
    const prevStock = this.getProductStock(idNum);
    const newStock = prevStock + delta;
    this.setProductStock(idNum, newStock);
    if (typeof fetch === 'function') {
      fetch('/api/db/admin/restock', {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ product_id: idNum, add_quantity: delta })
      }).catch(() => {});
    }
    this.showToast('เติมสต็อก "' + (name || ('#' + idNum)) + '" เพิ่ม +' + delta + ' ชิ้น (จากเดิม ' + prevStock + ' ➔ เป็น ' + newStock + ' ชิ้น) ในตาราง products เรียบร้อยแล้ว!');
    return newStock;
  },
  restockProduct(productId, name, addQty = 10) {
    return this.addProductStock(productId, addQty, name);
  },

  // ---------------- UI SYNC & TOAST ----------------
  updateCartBadge() {
    const badge = document.getElementById('cart-badge-count');
    if (badge) {
      const cart = this.getCart();
      const count = cart.reduce((sum, item) => sum + item.quantity, 0);
      badge.textContent = count;
    }
  },
  updateHeaderUI() {
    this.updateCartBadge();
    // Intercept Cart link clicks when not logged in
    if (typeof document !== 'undefined' && document.querySelectorAll) {
      document.querySelectorAll('a[href="cart.html"]').forEach(link => {
        link.onclick = (e) => {
          if (!this.getCurrentUser()) {
            e.preventDefault();
            this.requireLoginModal('เข้าดูตะกร้าสินค้า (Cart)');
            return false;
          }
        };
      });
    }
    const authArea = document.getElementById('nav-auth-area');
    if (!authArea) return;
    const user = this.getCurrentUser();
    if (!user) {
      authArea.innerHTML = `
        <a href="login.html" class="flex items-center gap-1.5 border border-slate-400 hover:border-white px-4 py-1.5 rounded-lg text-xs font-semibold text-white transition">
            <span>👤 Login</span>
        </a>
      `;
    } else {
      const initials = this.getInitials(user.name);
      const firstName = user.name.split(' ')[0];
      const adminLink = user.role === 'admin'
        ? `<a href="admin.html" class="bg-[#3b82f6] hover:bg-blue-600 text-white text-[11px] font-bold px-2.5 py-1 rounded-full transition">Admin Portal</a>`
        : '';
      authArea.innerHTML = `
        ${adminLink}
        <a href="profile.html" title="คลิกเพื่อดูโปรไฟล์ของ ${user.name}" class="flex items-center gap-2 bg-slate-800/80 hover:bg-slate-700 border border-slate-600 text-white pl-1.5 pr-3 py-1 rounded-full text-xs font-semibold transition">
            <span class="w-7 h-7 rounded-full bg-[#e2e8f0] text-[#0f172a] font-extrabold flex items-center justify-center text-[11px]">${initials}</span>
            <span>${firstName} ∨</span>
        </a>
      `;
    }
  },
  showToast(message, type = 'success') {
    let toast = document.getElementById('sport-cpe-toast');
    if (!toast) {
      toast = document.createElement('div');
      toast.id = 'sport-cpe-toast';
      toast.className = 'fixed bottom-6 right-6 z-50 bg-[#0b1329] text-white px-5 py-3.5 rounded-2xl shadow-2xl border border-slate-700 flex items-center gap-3 text-xs font-semibold transition-all duration-300';
      document.body.appendChild(toast);
    }
    const iconBadge = type === 'warn'
      ? '<span class="w-5 h-5 rounded-full bg-amber-500 text-white flex items-center justify-center font-bold text-[11px]">!</span>'
      : '<span class="w-5 h-5 rounded-full bg-[#22c55e] text-white flex items-center justify-center font-bold text-[11px]">✓</span>';
    toast.innerHTML = iconBadge + '<span>' + message + '</span>';
    toast.style.opacity = '1';
    toast.style.transform = 'translateY(0)';
    clearTimeout(this._toastTimer);
    this._toastTimer = setTimeout(() => {
      if (toast) {
        toast.style.opacity = '0';
        toast.style.transform = 'translateY(12px)';
      }
    }, 2800);
  }
};

document.addEventListener('DOMContentLoaded', () => {
  STATE.updateHeaderUI();
  // Auto-sync any previously registered localStorage users into MySQL sport_cpe_db.users
  if (typeof window !== 'undefined' && window.__LIVE_MYSQL_DB__ && typeof fetch === 'function') {
    try {
      const localRaw = localStorage.getItem('sport_cpe_users_db_v3');
      if (localRaw) {
        const localUsers = JSON.parse(localRaw);
        const mysqlUsers = window.__LIVE_MYSQL_DB__.users || [];
        localUsers.forEach(lu => {
          if (lu && lu.email && !mysqlUsers.some(mu => mu.email.toLowerCase() === lu.email.toLowerCase())) {
            fetch('/api/db/register', {
              method: 'POST',
              headers: { 'Content-Type': 'application/json' },
              body: JSON.stringify({
                name: lu.name,
                email: lu.email,
                password: lu.password || 'password123',
                phone: lu.phone || '0891234567',
                address: lu.address || 'Chiang Mai'
              })
            }).then(r => r.json()).then(data => {
              if (data && data.ok && data.user) {
                mysqlUsers.push(data.user);
                const cur = STATE.getCurrentUser();
                if (cur && cur.email.toLowerCase() === data.user.email.toLowerCase()) {
                  STATE.setCurrentUser(data.user);
                }
              }
            }).catch(() => {});
          }
        });
      }
    } catch (e) {}
  }
});
