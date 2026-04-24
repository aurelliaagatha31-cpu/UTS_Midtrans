# UTS Midtrans

Project Laravel dengan integrasi pembayaran Midtrans (Sandbox)

# Fitur:
- Payment Gateway Midtrans
- Virtual Account
- Webhook Callback
- Subscription Premium

# Cara menjalankan:
1. composer install
2. cp .env.example .env
3. php artisan key:generate
4. php artisan migrate
5. php artisan serve

- php artisan serve
- ngrok http 8000
- URL Forwarding: https://dice-mossy-national.ngrok-free.dev/api/midtrans-callback

### Pembayaran Berhasil
<img width="1365" height="721" alt="image" src="https://github.com/user-attachments/assets/c59aba47-ccb0-431b-b648-3ec1f2736e93" />

### Database Terisi
<img width="1365" height="718" alt="image" src="https://github.com/user-attachments/assets/8d8b5b6b-46e3-4e6c-b657-fa74d8c3ff54" />

### Webhook Masuk
<img width="1365" height="767" alt="Screenshot 2026-04-24 135713" src="https://github.com/user-attachments/assets/dbe39b82-8b42-4a12-874e-4750bc3a881e" />
