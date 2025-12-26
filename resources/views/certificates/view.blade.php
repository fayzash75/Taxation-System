<!DOCTYPE html>
<html dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>وثيقة براءة ذمة - {{ $certificate->certificate_number }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Tajawal', sans-serif;
        }

        .certificate-container {
            background-color: white;
            border: 2px solid #0d6efd;
            border-radius: 15px;
            padding: 30px;
            margin: 30px auto;
            max-width: 1000px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .header {
            text-align: right;
            border-bottom: 3px solid #0d6efd;
            padding-bottom: 10px;
            margin-bottom: 10px;
            font-size: 10 px;
        }

        .title {
            color: #0d6efd;
            font-weight: bold;
            font-size: 12px;
        }

        .subtitle {
            color: #6c757d;
            font-size: 12px;
        }

        .stamp {
            position: absolute;
            left: 30px;
            bottom: 30px;
            opacity: 0.8;
            transform: rotate(-15deg);
        }

        .info-card {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 10px;
        }

        .info-label {
            font-weight: bold;
            color: #495057;
            margin-bottom: 5px;
        }

        .info-value {
            color: #212529;
            font-size: 12px;
        }

        .status-badge {
            font-size: 12px;
            padding: 8px 20px;
        }

        .watermark {
            position: absolute;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            font-size: 14px;
            color: rgba(0, 0, 0, 0.05);
            font-weight: bold;
            white-space: nowrap;
        }

        .action-buttons {
            margin-top: 30px;
            text-align: center;
        }
    </style>
</head>

<body>
    @if(!$taxPayer)
    <div class="container">
        <div class="error-alert alert alert-danger text-content">
            <div class="watermark"> خطأ في البيانات</div>
            <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg mx-2">
                <i class="fas fa-arrow-right"></i> عودة
            </a>
        </div>
    </div>
    @php return; @endphp
    @endif
    <div class="container">
        <div class="certificate-container">
            <div class="=" watermark" style="text-align: left ;">وثيقة رسمية</div>
            <div class="=" watermark" style="text-align: left ;">
                {{ $certificate->is_valid ? 'سارية المفعول' : 'ملغاة' }}
            </div>
            <div class="header">
                <h5>الجمهورية العربية السورية</h5>
                <h5>الهيئة العامة للضرائب والرسوم</h5>
                <h5>مديرية مالية دمشق</h5>
                <div style="text-align: center ; font-weight: bold; font-size: 14px; ">
                    <h4> براءة ذمة </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="info-card">
                        <div class="info-label">رقم الوثيقة</div>
                        <div class="info-value">{{ $certificate->certificate_number }}</div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">تاريخ الإصدار</div>
                        <div class="info-value">{{ $certificate->issue_date->format('Y-m-d') }}</div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">صالحة حتى</div>
                        <div class="info-value">{{ $certificate->valid_until->format('Y-m-d') }}</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="info-card">
                        <div class="info-label">اسم المكلف</div>
                        <div class="info-value">{{$taxPayer->name ?? 'غير متوفر' }}</div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">الرقم الضريبي</div>
                        <div class="info-value">{{ $taxPayer->tax_number  ?? 'غير متوفر'}}</div>
                    </div>
                    <div class="info-card">
                        <div class="info-label">السجل التجاري</div>
                        <div class="info-value">{{ $taxPayer->commercial_registration ?? 'غير متوفر '}}</div>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <div class="info-card">
                        <div class="info-label">العنوان</div>
                        <div class="info-value">{{ $taxPayer->address ?? 'غير متوفر '}}</div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">الحالة الضريبية</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3 text-center">
                                    <div class="info-label">إجمالي الديون</div>
                                    <div class="info-value text-danger">{{ number_format($taxPayer->total_debt) }} ليرة</div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="info-label">إجمالي المدفوع</div>
                                    <div class="info-value text-success">{{ number_format($taxPayer->total_paid) }} ليرة</div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="info-label">الدين المتبقي</div>
                                    <div class="info-value {{ $taxPayer->remaining_debt > 0 ? 'text-danger' : 'text-success' }}">
                                        {{ number_format($taxPayer->remaining_debt) }} ليرة
                                    </div>
                                </div>
                                <div class="col-md-3 text-center">
                                    <div class="info-label">أهلية البراءة</div>
                                    <div class="info-value {{ $taxPayer->isEligibleForClearance() ? 'text-success' : 'text-danger' }}">
                                        {{ $taxPayer->isEligibleForClearance() ? 'مؤهل' : 'غير مؤهل' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($certificate->notes)
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0">ملاحظات</h5>
                        </div>
                        <div class="card-body">
                            <p>{{ $certificate->notes }}</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="action-buttons">
                <a href="{{ route('certificates.print', $certificate) }}" class="btn btn-success btn-lg mx-2" target="_blank">
                    <i class="fas fa-print"></i> طباعة
                </a>
                <a href="javascript:window.print()" class="btn btn-warning btn-lg mx-2">
                    <i class="fas fa-print"></i> طباعة الصفحة
                </a>
                <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg mx-2">
                    <i class="fas fa-arrow-right"></i> رجوع
                </a>
            </div>
        </div>
    </div>
    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // إضافة تأثير عند الطباعة
        window.addEventListener('beforeprint', function() {
            document.querySelector('.action-buttons').style.display = 'none';
        });

        window.addEventListener('afterprint', function() {
            document.querySelector('.action-buttons').style.display = 'block';
        });
    </script>
</body>

</html>