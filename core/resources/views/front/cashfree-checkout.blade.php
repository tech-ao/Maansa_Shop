<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connecting to Cashfree Payments...</title>
    <!-- Cashfree PG JS SDK v3 -->
    <script src="https://sdk.cashfree.com/js/v3/cashfree.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
        }
        body {
            background: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .cashfree-pay-card {
            background: #ffffff;
            border-radius: 24px;
            padding: 44px 36px;
            max-width: 440px;
            width: 100%;
            text-align: center;
            box-shadow: 0 20px 45px -10px rgba(15, 23, 42, 0.12), 0 0 0 1px rgba(15, 23, 42, 0.04);
        }
        .logo-circle {
            width: 68px;
            height: 68px;
            border-radius: 20px;
            background: linear-gradient(135deg, #7952FC 0%, #4f46e5 100%);
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 20px;
            box-shadow: 0 10px 25px -5px rgba(121, 82, 252, 0.4);
            animation: pulseGlow 2s infinite ease-in-out;
        }
        @keyframes pulseGlow {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.05); opacity: 0.9; }
        }
        h2 {
            font-size: 20px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 8px;
        }
        p {
            font-size: 13.5px;
            color: #64748b;
            line-height: 1.5;
            margin-bottom: 24px;
        }
        .amount-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 18px;
            background: #f1f5f9;
            border-radius: 9999px;
            font-size: 14px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 28px;
        }
        .spinner {
            width: 32px;
            height: 32px;
            border: 3.5px solid #e2e8f0;
            border-top: 3.5px solid #7952FC;
            border-radius: 50%;
            margin: 0 auto 16px;
            animation: spin 0.8s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .security-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 11.5px;
            font-weight: 600;
            color: #10b981;
            background: #ecfdf5;
            padding: 4px 12px;
            border-radius: 999px;
        }
    </style>
</head>
<body>

    <div class="cashfree-pay-card">
        <div class="logo-circle">
            <i class="fa-solid fa-bolt"></i>
        </div>
        <h2>Redirecting to Cashfree</h2>
        <p>Opening secure Cashfree checkout window.<br>Please do not refresh or close this page.</p>

        <div class="amount-pill">
            <span>Order Total:</span>
            <span style="color: #4f46e5;">₹{{ number_format($total_amount, 2) }}</span>
        </div>

        <div class="spinner"></div>

        <div>
            <span class="security-badge">
                <i class="fa-solid fa-shield-check"></i> 256-Bit SSL Encrypted & RBI Regulated
            </span>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            try {
                const cashfree = Cashfree({
                    mode: "{{ $mode }}" // "sandbox" or "production"
                });

                cashfree.checkout({
                    paymentSessionId: "{{ $payment_session_id }}",
                    redirectTarget: "_self"
                });
            } catch (err) {
                console.error("Cashfree SDK Initialization Error:", err);
                alert("Failed to launch Cashfree checkout. Redirecting back to store...");
                window.location.href = "{{ route('front.checkout.redirect') }}";
            }
        });
    </script>
</body>
</html>
