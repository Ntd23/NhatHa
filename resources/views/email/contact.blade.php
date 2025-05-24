@component('mail::message')
  Chào admin, <br />
  <p>Họ tên: <b>{{ $user->name }}</b></p>
  <p>Email: <b></b>{{ $user->email }}</p>
  <p>Điện thoại: <b></b>{{ $user->email }}</p>
  <p>Chủ đề: <b></b>{{ $user->phone }}</p>
  <p>Nội dung: <b></b>{{ $user->message }}</p>
@endcomponent
 