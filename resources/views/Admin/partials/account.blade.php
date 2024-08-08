<div class="intro-x dropdown w-8 h-8">
    <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in" role="button" aria-expanded="false" data-tw-toggle="dropdown">
        <img alt="Tinker Tailwind HTML Admin Template" src="{{ asset('admin/admin.png') }}">
    </div>
    <div class="dropdown-menu w-56">
        <ul class="dropdown-content bg-primary text-white">
            <li class="p-2">
                <div class="font-medium">{{ auth()->user()->name }}</div>
            </li>
{{--            <li>--}}
{{--                <hr class="dropdown-divider border-white/[0.08]">--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="" class="dropdown-item hover:bg-white/5"> <i data-feather="user" class="w-4 h-4 mr-2"></i> Profile </a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="" class="dropdown-item hover:bg-white/5"> <i data-feather="edit" class="w-4 h-4 mr-2"></i> Add Account </a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="" class="dropdown-item hover:bg-white/5"> <i data-feather="lock" class="w-4 h-4 mr-2"></i> Reset Password </a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <a href="" class="dropdown-item hover:bg-white/5"> <i data-feather="help-circle" class="w-4 h-4 mr-2"></i> Help </a>--}}
{{--            </li>--}}
{{--            <li>--}}
{{--                <hr class="dropdown-divider border-white/[0.08]">--}}
{{--            </li>--}}
            <li>
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item hover:bg-white/5"> <i data-feather="toggle-right" class="w-4 h-4 mr-2"></i> Logout </button>
                </form>
            </li>
        </ul>
    </div>
</div>
