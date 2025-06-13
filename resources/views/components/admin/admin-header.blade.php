<div class="flex justify-between items-center px-4 py-4 bg-white">
    <h1 class="text-xl font-medium text-gray-700">{{ $title }}</h1>
    <div class="flex gap-4 items-center justify-end">
        <a href="/admin/profile" class="flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-200">
            <i class="hgi hgi-stroke hgi-user text-xl"></i>
        </a>
        <form action="{{ route('Logout-admin') }}" method="post">
            @csrf
            <button type="submit" class="flex items-center justify-center w-10 h-10 rounded-full hover:bg-gray-200">
                <i class="hgi hgi-stroke hgi-logout-03 text-xl"></i>
            </button>
        </form>
    </div>
</div>