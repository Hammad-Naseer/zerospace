@if($errors ->any() > 0)
@foreach($errors ->all() as $error)
<script>
Lobibox.notify('warning', {
    pauseDelayOnHover: true,
    size: 'mini',
    icon: 'bx bx-check-circle',
    continueDelayOnInactiveTab: false,
    position: 'center top',
    msg: "{{ $error }}"
});
</script>
@endforeach
@endif



@if(Session::has('message'))
<script>
Lobibox.notify('success', {
    pauseDelayOnHover: true,
    size: 'mini',
    icon: 'bx bx-check-circle',
    continueDelayOnInactiveTab: false,
    position: 'center top',
    msg: "{{Session::get('message')}}",
});
</script>
@endif


@if(Session::has('error'))
<script>
Lobibox.notify('warning', {
    pauseDelayOnHover: true,
    size: 'mini',
    icon: 'bx bx-check-circle',
    continueDelayOnInactiveTab: false,
    position: 'center top',
    msg: "{{Session::get('error')}}"
});
</script>
@endif