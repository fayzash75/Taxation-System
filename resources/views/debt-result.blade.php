<!DOCTYPE html>
<html dir="rtl">
<head>
    <title>نتيجة الاستعلام</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-secondary text-white">
                <h6 class="mb-0">نتيجة الاستعلام</h6>
            </div>
            @if (!$taxPayer) 
                <div class="alert alert-danger mt-3">
                        <h6> لا يوجد مكلف بهذا الرقم  </h6>
                        <strong> تأكد من صحة البيانات وأعد المحاولة </strong>
                </div>
                <a href="{{ route('public.check-debt') }}" class="btn btn-secondary mt-3">عودة</a>
            @elseif ($taxPayer)
            <div class="card-body">
                <h5>المكلف: {{ $taxPayer->name }}</h5>
                <p><strong>الرقم الضريبي:</strong> {{ $taxPayer->tax_number }}</p>
                <p><strong>إجمالي الديون:</strong> {{ number_format($taxPayer->total_debt) }} ليرة</p>
                <p><strong>إجمالي المدفوع:</strong> {{ number_format($taxPayer->total_paid) }} ليرة</p>
                <p><strong>الدين المتبقي:</strong> {{ number_format($taxPayer->remaining_debt) }} ليرة</p>

                @if($taxPayer->isEligibleForClearance())
                    <!-- <div class="alert alert-success mt-3">
                        <strong>يمكنك طلب وثيقة البراءة.</strong>
                        <form method="POST" action="{{ route('public.request-clearance', $taxPayer->id) }}" class="mt-2">
                            @csrf
                            <button type="submit" class="btn btn-success">طلب وثيقة براءة الذمة</button>
                        </form>
                    </div> -->
                    <div class="alert alert-danger mt-3">
                        <p> <strong>خدمة طلب براءة الذمة متوقفة الآن </strong></p>
                        <p> <strong> بسبب الصيانة حاول لاحقاً </strong></p>
                        <p> <strong> يمكنك التوجه لأقرب مركز خدمة </strong></p>
                    </div>
                @else
                    <div class="alert alert-danger mt-3">
                        <strong> المكلف مدين , لا يمكن طلب وثيقة البراءة  </strong>
                    </div>
                @endif

               <a href="{{ route('public.check-debt') }}" class="btn btn-secondary mt-3">عودة</a>
            </div>
            @endif
        </div>
    </div>
</body>
</html>