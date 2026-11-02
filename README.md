# SPORT.CPE — E-Commerce Web Application (261342 Database Systems)

> **วิชา**: 261342 Database Systems (ภาควิชาวิศวกรรมคอมพิวเตอร์ คณะวิศวกรรมศาสตร์ มหาวิทยาลัยเชียงใหม่)  
> **กลุ่ม Term Project**: Project 2  
> **สมาชิกในกลุ่ม**:  
> 1. ณภัทร จิตเจริญ (670610686)  
> 2. ภูรินท์ อินทจักร์ (670610723)  
> 3. วรภพ เกิดทองสุก (670610729)  
> **ฐานข้อมูล**: MySQL 8.0 `sport_cpe_db` (7 ตารางระดับ 3NF: `categories`, `users`, `promotions`, `products`, `promotion_products`, `orders`, `order_items`)  
> **Figma Prototype**: [SportsShop - Low-Fi Prototype (11 Frames)](https://www.figma.com/design/6ETgU6OQVA3jAn5g673JSr/SportsShop---Low-Fi-Prototype?node-id=0-1&t=gA0Xnw1otgDClhfp-1)  

---

## 🛠️ Tech Stack
* **Frontend**: HTML5, JavaScript (ES6+), Tailwind CSS
* **Backend**: Node.js + `mysql2` (`server.js`), Laravel MVC Architecture (`routes/web.php`, `app/Models/`, `app/Http/Controllers/`)
* **Database**: MySQL 8.0 (`sport_cpe_db` บน Docker Container พอร์ต `3306`)
* **Tools**: Docker Desktop, DBeaver, Figma, Draw.io, VS Code

---

## 🚀 วิธีการติดตั้งและรันโปรเจกต์ (How to Run)

### ขั้นตอนที่ 1: เตรียมฐานข้อมูล MySQL (`sport_cpe_db`)
1. เปิด **Docker Desktop** และรัน MySQL Container บนพอร์ต `3306` (`user: root`, `password: rootpass123`)
2. เปิดโปรแกรม **DBeaver** แล้วรันสคริปต์ไฟล์ **`database/schema.sql`** เพื่อสร้างฐานข้อมูล `sport_cpe_db` ทั้ง 7 ตารางพร้อมข้อมูลตั้งต้น (128 สินค้า, 8 หมวดหมู่, 4 โปรโมชัน, 6 บัญชีผู้ใช้, 12 คำสั่งซื้อ)

### ขั้นตอนที่ 2: ติดตั้ง Dependencies และรัน Web Server
เปิด Terminal ในโฟลเดอร์โปรเจกต์ (`sport-cpe-app`) แล้วรันคำสั่ง:
```bash
npm install
npm start
```
*(หรือรัน `node server.js` หรือดับเบิลคลิกไฟล์ `start_server.bat`)*

จากนั้นเปิดเบราว์เซอร์ไปที่:
👉 **`http://localhost:8000`**

---

## 🔑 บัญชีสำหรับทดสอบระบบ (Test Accounts)

| บทบาท (Role) | อีเมล (Email) | รหัสผ่าน (Password) | รายละเอียด |
| :--- | :--- | :--- | :--- |
| **Admin (ผู้ดูแลระบบ)** | `admin@sportcpe.com` | `password123` *(หรือ `admin123`)* | เข้าหน้า Admin Dashboard (`http://localhost:8000/admin.html`) เพื่อเติมสต็อก (`+ Restock`), จัดการสินค้าโปร `Buy 2 Get 1 Free`, และอัปเดตสถานะคำสั่งซื้อ |
| **Customer (ลูกค้า)** | `kongkai@cpe.eng.cmu.ac.th` | `password123` | บัญชีลูกค้าตั้งต้นสำหรับทดสอบการเก็บคูปอง (`SAVE15`, `PERKS20`, `SPORT10`), ซื้อสินค้าโปร `Buy 2 Get 1 Free`, และสั่งซื้อสินค้าแบบ ACID Transaction |

---

## 🗺️ โครงสร้างหน้าเว็บทั้ง 11 หน้าจอ (11 Pages Sitemap)
1. **Home Page (`index.html`)**: แบนเนอร์โปรโมชัน, ระบบเรียงลำดับราคา (`Sort by`), สวิตช์กรองสินค้า `Buy 2 Get 1 Free Eligible` และระบบแบ่งหน้า Pagination 11 หน้า (128 สินค้า)
2. **Category Catalog (`products.html`)**: แสดงสินค้าแยกตาม 8 หมวดหมู่กีฬา พร้อมดึงคำอธิบายหมวดหมู่ (`categories.description`) จากฐานข้อมูลจริง
3. **Product Detail (`product-detail.html`)**: รายละเอียดสินค้า, สต็อกคงเหลือจริงจากตาราง `products`, และป้ายสิทธิ์โปรโมชันจากตาราง `promotion_products`
4. **Voucher Center (`vouchers.html`)**: คูปองส่วนลด `SAVE15` (ลด 15%), `PERKS20` (ลด 20%), `SPORT10` (ลด 10%) และแบนเนอร์โปรโมชันอัตโนมัติ `BUY2GET1`
5. **Shopping Cart (`cart.html`)**: คำนวณโปรโมชัน `Buy 2 Get 1 Free` รายอุปกรณ์ (ซื้อ 2 ชิ้น แถมฟรี 1 ชิ้นอัตโนมัติ) และใช้โค้ดคูปองส่วนลด
6. **Checkout Page (`checkout.html`)**: ดึงที่อยู่จัดส่งจริงจากตาราง `users`, แบบฟอร์มกรอกบัตรเครดิต 16 หลัก, และปุ่ม `Place Order` ที่ทำงานแบบ **ACID Database Transaction** (`INSERT INTO orders`, `INSERT INTO order_items`, `UPDATE products`)
7. **Order Complete (`order-complete.html`)**: หน้าใบเสร็จสรุปคำสั่งซื้อและหมายเลขพัสดุ
8. **Register (`register.html`)**: สมัครสมาชิกใหม่พร้อมระบบตรวจสอบเบอร์โทรศัพท์ 10 หลักขึ้นต้นด้วย 0 (`INSERT INTO users`)
9. **Login (`login.html`)**: เข้าสู่ระบบสมาชิกและผู้ดูแลระบบ
10. **Member Profile (`profile.html`)**: แก้ไขข้อมูลส่วนตัว (`UPDATE users`) และดูประวัติการสั่งซื้อเฉพาะของตนเอง (`SELECT * FROM orders WHERE user_id = ?`)
11. **Admin Dashboard (`admin.html`)**: สรุปยอดขายจากฐานข้อมูลจริง, ระบบแจ้งเตือนสต็อกต่ำ (`Stock ≤ 10`) พร้อมช่องกรอกจำนวนบวกเพิ่มสต็อก (`+ Restock`), ระบบเลือกและยืนยันสินค้าเข้าโปรโมชัน `Buy 2 Get 1 Free` (`promotion_products`), และตารางจัดการสถานะคำสั่งซื้อ (`orders` & `order_items`)
