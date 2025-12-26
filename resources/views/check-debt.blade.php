<!DOCTYPE html>
<html dir="rtl">

<head>
    <title> مديونية المكلفين</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-secondary text-white">
                <h6 class="mb-0">استعلام عن مديونية المكلفين </h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('public.query-debt') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="tax_number" class="form-label">: أدخل الرقم الضريبي</label>
                        <input type="text" class="form-control" id="tax_number" name="tax_number" required>
                    </div>
                    <button type="submit" class="btn btn-primary">استعلام</button>
                    <div class="mt-6 pt-6 border-t border-gray-200 text-center">
                        <p class="text-gray-600">
                            <i class="fas fa-info-circle ml-2"></i>
                            للوصول إلى جميع الخدمات، يرجى زيارة
                            <a href="/public/check-debt" class="text-blue-600 hover:underline"> خدمات المكلفين </a>
                        </p>
                    </div>
            </div>

            <div class="mt-8 text-center text-gray-500">
                <p>© 2026 هيئة الضرائب والرسوم . جميع الحقوق محفوظة </p>
            </div>
            </form>
        </div>
    </div>
    </div>
</body>

</html>