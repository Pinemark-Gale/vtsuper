<div class="admin-panel-header">
    @if (auth()->user()->privilegeCheck('admin'))
        <a href="{{ route('admin-users') }}" class="">Users</a>
        <a href="{{ route('admin-privileges') }}" class="">Privileges</a>
        <a href="{{ route('admin-pages') }}" class="">Pages</a>
    @endif
    @if (auth()->user()->privilegeCheck('teacher'))
        <a href="{{ route('admin-schools') }}" class="">Schools</a>
        <a href="{{ route('admin-resource-tags') }}" class="">Resource Tags</a>
        <a href="{{ route('admin-resource-types') }}" class="">Resource Types</a>
    @endif
    @if (auth()->user()->privilegeCheck('contributor'))
        <a href="{{ route('admin-sources') }}" class="">Sources</a>
        <a href="{{ route('admin-resources') }}" class="">Resources</a>
        <a href="{{ route('admin-activities') }}" class="">Activities</a>
    @endif
</div>