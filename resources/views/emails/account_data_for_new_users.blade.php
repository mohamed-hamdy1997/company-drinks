<div style="text-align: right; direction: rtl">
    <h1>تم اضافتك الي موقع المشاريب الخاص ب {{env('APP_NAME')}}</h1>
    <br>
    <h2>بيانات حسابك:</h2>
    <h4>الاسم: {{$user->name}}</h4>
    <h4>الدور:
        @if($user->type == \App\Enums\AUserType::ADMIN)
            ادمن
        @elseif($user->type == \App\Enums\AUserType::EMPLOYEE)
            موظف
        @else
            عامل مكتب
        @endif
    </h4>

    <h4>البريد الالكتروني: {{$user->email}}</h4>
    <h4>الرقم السري: {{$password}}</h4>

</div>
