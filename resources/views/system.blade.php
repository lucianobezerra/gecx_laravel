<ul>
  @can('auth', 'admin_system_view');
    <li>View</li>
  @endcan
  
  @can('auth', 'admin_system_edit');
    <li>Edit</li>
  @endcan
</ul>