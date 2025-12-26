<!DOCTYPE html>
<html dir="rtl">
<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Clearance certificate - {{ $certificate->certificate_number }}</title>
    <style>
        @page { margin: 20px; }
        body { 
            font-family: 'Tajawal' ,sans-serif; 
            line-height: 1.6;
            color: #333;
        }
        .header { 
            text-align: center; 
            margin-bottom: 30px; 
            border-bottom: 3px solid #0d6efd; 
            padding-bottom: 20px; 
        }
        .title { 
            font-size: 24px; 
            font-weight: bold; 
            color: #0d6efd; 
        }
        .subtitle { 
            font-size: 18px; 
            color: #6c757d; 
            margin-top: 5px; 
        }
        .content { 
            margin: 20px 0; 
        }
        .section { 
            margin-bottom: 20px; 
            page-break-inside: avoid; 
        }
        .section-title { 
            font-size: 16px; 
            font-weight: bold; 
            color: #495057; 
            margin-bottom: 10px; 
            padding-bottom: 5px; 
            border-bottom: 1px solid #dee2e6; 
        }
        .info-table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-bottom: 15px; 
        }
        .info-table td { 
            padding: 8px; 
            border: 1px solid #dee2e6; 
        }
        .info-label { 
            font-weight: bold; 
            background-color: #f8f9fa; 
            width: 30%; 
        }
        .stamp { 
            position: absolute; 
            right: 50px; 
            bottom: 100px; 
            opacity: 0.7; 
        }
        .footer { 
            position: fixed; 
            bottom: 0; 
            width: 100%; 
            text-align: center; 
            font-size: 12px; 
            color: #6c757d; 
            border-top: 1px solid #dee2e6; 
            padding-top: 10px; 
        }
        .status-badge { 
            display: inline-block; 
            padding: 5px 15px; 
            border-radius: 20px; 
            font-size: 14px; 
            margin-top: 10px; 
        }
        .valid { background-color: #d1e7dd; color: #0f5132; }
        .invalid { background-color: #f8d7da; color: #842029; }
        .watermark { 
            position: absolute; 
            left: 50%; 
            top: 50%; 
            transform: translate(-50%, -50%) rotate(-45deg); 
            font-size: 60px; 
            color: rgba(0,0,0,0.05); 
            font-weight: bold; 
        }
    </style>
</head>
<body>
    <div class="watermark">وثيقة رسمية</div>
    <div class="header">
        <div class="title">الجمهوريةالعربية السورية </div>
        <div class="subtitle">  مديرية مالية دمشق </div>
        <div class="title">وثيقة براءة ذمة ضريبية</div>
        <div class="status-badge {{ $certificate->is_valid ? 'valid' : 'invalid' }}">
            {{ $certificate->is_valid ? 'سارية المفعول' : 'ملغاة' }}
        </div>
    </div>   
    <div class="content">
        <div class="section">
            <div class="section-title">معلومات الوثيقة</div>
            <table class="info-table">
                <tr>
                    <td class="info-label">رقم الوثيقة:</td>
                    <td>{{ $certificate->certificate_number }}</td>
                </tr>
                <tr>
                    <td class="info-label">تاريخ الإصدار:</td>
                    <td>{{ $certificate->issue_date->format('Y-m-d') }}</td>
                </tr>
                <tr>
                    <td class="info-label">صالحة حتى:</td>
                    <td>{{ $certificate->valid_until->format('Y-m-d') }}</td>
                </tr>
            </table>
        </div>
        
        <div class="section">
            <div class="section-title">معلومات المكلف</div>
            <table class="info-table">
                <tr>
                    <td class="info-label">الاسم:</td>
                    <td>{{ $taxPayer->name }}</td>
                </tr>
                <tr>
                    <td class="info-label">الرقم الضريبي:</td>
                    <td>{{ $taxPayer->tax_number }}</td>
                </tr>
                <tr>
                    <td class="info-label">السجل التجاري:</td>
                    <td>{{ $taxPayer->commercial_registration }}</td>
                </tr>
                <tr>
                    <td class="info-label">العنوان:</td>
                    <td>{{ $taxPayer->address }}</td>
                </tr>
            </table>
        </div>
        
        <div class="section">
            <div class="section-title">المديونية : </div>
            <table class="info-table">
                <tr>
                    <td class="info-label">إجمالي الديون:</td>
                    <td>{{ number_format($taxPayer->total_debt, 2) }} ريال</td>
                </tr>
                <tr>
                    <td class="info-label">إجمالي المدفوع:</td>
                    <td>{{ number_format($taxPayer->total_paid, 2) }} ريال</td>
                </tr>
                <tr>
                    <td class="info-label">الدين المتبقي:</td>
                    <td>{{ number_format($taxPayer->remaining_debt, 2) }} ريال</td>
                </tr>
                <tr>
                    <td class="info-label">أهلية البراءة:</td>
                    <td>{{ $taxPayer->isEligibleForClearance() ? 'مؤهل' : 'غير مؤهل' }}</td>
                </tr>
            </table>
        </div>
        
        @if($certificate->notes)
        <div class="section">
            <div class="section-title">ملاحظات</div>
            <p>{{ $certificate->notes }}</p>
        </div>
        @endif
        
        <div class="section">
            <div class="section-title">تصريح وإقرار</div>
            <p> بناء على الطلب المقدم من المكلف المذكور أعلاه، لانرى مانعا من الناحية الضريبية لمنحه براءة ذمة مالية  </p>
        </div>
    </div>
    
</body>
</html>