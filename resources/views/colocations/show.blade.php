<div>
 @role('admin')
    <p>مرحباً Admin!</p>
@endrole

@unlessrole('admin')
    <p>ماشي Admin</p>
@endunlessrole
</div>
