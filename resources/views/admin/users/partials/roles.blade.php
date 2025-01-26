@forelse($user->roles as $role)
<span class="badge bg-aqua">{{ $role->display_name }}</span>
@empty
<span class="badge bg-aqua">مشتری</span>
@endforelse