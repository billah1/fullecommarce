@extends('Admin.master')
@push('css')

@endpush
@section('content')
    <h2 class="intro-y text-lg font-medium mt-10">
        Order List
    </h2>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a id="programmatically-show-modal" href="javascript:void(0);" class="btn btn-primary shadow-md mr-2">Add
                New
                Product</a>
            <div class="dropdown">
                <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                    <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-feather="plus"></i>
                    </span>
                </button>
                <div class="dropdown-menu w-40">
                    <ul class="dropdown-content">
                        <li>
                            <a href="" class="dropdown-item"> <i data-feather="printer" class="w-4 h-4 mr-2"></i>
                                Print </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i>
                                Export to Excel </a>
                        </li>
                        <li>
                            <a href="" class="dropdown-item"> <i data-feather="file-text" class="w-4 h-4 mr-2"></i>
                                Export to PDF </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="hidden md:block mx-auto text-slate-500">Showing 1 to 10 of 150 entries</div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">
                    <input type="text" class="form-control w-56 box pr-10" placeholder="Search...">
                    <i class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-feather="search"></i>
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                <tr>
                    <th class="whitespace-nowrap">Sl no</th>
                    <th class="whitespace-nowrap">Order Number</th>
                    <th class="text-center whitespace-nowrap">Customer Name</th>
                    <th class="text-center whitespace-nowrap">Status</th>
                    <th class="text-center whitespace-nowrap">Date</th>
                    <th class="text-center whitespace-nowrap">ACTIONS</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($items as $item)
                    <tr class="intro-x">
                        <td class="w-40">
                            <div class="flex">
                                <div class="w-10 h-10 image-fit zoom-in">
                                    {{ $loop->iteration }}
                                </div>
                            </div>
                        </td>
                        <td>
                            {{--                            TODO::Need to implement click to go products --}}
                            <a href="" class="font-medium whitespace-nowrap">{{ $item->order_code }}</a>
                        </td>
                        <td class="text-center">
                            <a href="" class="font-medium whitespace-nowrap">{{ $item->user->name }}</a>
                        </td>
                        <td class="text-center">
                            <a href="" class="font-medium whitespace-nowrap">{{ $item->status }}</a>
                        </td>
                        <td class="w-40 status">
                            <a href="" class="font-medium whitespace-nowrap">{{ $item->created_at->format('jS F, Y') }}</a>
                        </td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                @if($item->status === \App\Models\Order::STATUS_PENDING)
                                    <a href="{{ route('completeOrder', [$item->id]) }}" class="flex items-center mr-3 edit-button"><i
                                            data-feather="check-square" class="w-4 h-4 mr-1"></i> Mark as done
                                    </a>
                                @endif
                                <a href="{{ route('user.invoice', [$item->id]) }}" target="_blank" class="flex items-center mr-3 edit-button"><i
                                        data-feather="check-square" class="w-4 h-4 mr-1"></i> View Invoice
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <!-- BEGIN: Pagination -->
        {{ $items->links('vendor.pagination.tailwind-pagination') }}
    </div>
@endsection
@push('js')

@endpush
