<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đơn Thuốc</title>
    <style>
        @font-face {
            font-family: 'DejaVu Sans';
            src: url('{{ storage_path('fonts/DejaVuSans.ttf') }}');
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            width: 100%;
            height: 600px;
        }

        .header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 100px;
            height: auto;
            margin-right: 10px;
        }

        .header .hospital-info {
            text-align: left;
            position: absolute;
        }

        .header h4,
        .header p {
            margin: 2px 0;
        }

        .header h4 {
            font-size: 18px;
            text-transform: uppercase;
        }

        h2 {
            text-align: center;
        }

        .patient-info p,
        .footer p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
        }

        .footer {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            
            /* margin-top: 20px; */
        }
        .footer .right{
            position: absolute;
            right:0;
            top:0;
        }

        
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ base_path('public/backend/assets/images/logos/logo.png') }}" alt="Hospital Logo">
        <div class="hospital-info">
            <h4>Bệnh Viện VietCare</h4>
            <p><strong>Địa chỉ: </strong>315, Nguyễn Văn Linh, An Khánh, Ninh Kiều</p>
            <p><strong>SĐT: </strong> 0292.382.0071 - 0292.382.3167</p>
        </div>
    </div>

    <h2>ĐƠN THUỐC</h2>
    <div class="patient-info">
        <p><strong>Họ tên người bệnh:</strong> {{ $data['medicals'][0]->last_name }}
            {{ $data['medicals'][0]->first_name }}</p>
        <p><strong>Ngày sinh:</strong> 2004</p>
        <p><strong>Địa chỉ:</strong> {{ $data['medicals'][0]->address }}</p>
        @if ($data['medicals'][0]->gender == 1)
            <p><strong>Giới tính:</strong> Nam</p>
        @else
            <p><strong>Giới tính:</strong> Nữ</p>
        @endif
        <p><strong>Khoa khám bệnh:</strong> {{ $data['medicals'][0]->specialty }}</p>
    </div>

    <h3>Danh Sách Thuốc</h3>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Tên Thuốc</th>
                <th>Ngày uống</th>
                <th>Số Lượng</th>
                <th>Liều Lượng</th>
                <th>Cách dùng</th>
            </tr>
        </thead>
        <tbody>
            @php $count = 1; @endphp
            @foreach ($data['medicines'] as $medicine)
                <tr>
                    <td>{{ $count++ }}</td>
                    <td>{{ $medicine['name'] }}</td>
                    <td>{{ $medicine['dosage'] }}</td>
                    <td>{{ $medicine['quantity'] }}</td>
                    <td>{{ $medicine['usage'] }}</td>
                    <td>{{ $medicine['note'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        <div class="left">
            <p class="notes"><strong>Ngày tái khám:</strong>
                {{ \Carbon\Carbon::parse($data['medicals'][0]->re_examination_date)->format('d/m/Y') }}</p>
            <p class="notes"><strong>Chuẩn đoán:</strong> {{ $data['medicals'][0]->diaginsis }}</p>
            <p class="notes"><strong>Lời dặn:</strong> {{ $data['medicals'][0]->advice }}</p>
            <p class="notes"><strong>Ghi chú:</strong></p>
        </div>
        <div class="right">
            <p><strong>Ngày:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
            <p><strong>Bác sĩ điều trị:</strong> {{ $data['medicals'][0]->last_name_doctor }}
                {{ $data['medicals'][0]->first_name_doctor }}</p>
        </div>
    </div>
    

</body>

</html>
