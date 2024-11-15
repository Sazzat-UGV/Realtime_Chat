@extends('backend.layouts.app')
@section('title')
    Chat
@endsection
@push('style')
@endpush
@section('content')
    @include('backend.layouts.include.breadcrumb', [
        'parent_page' => '',
        'page_name' => 'Chat',
    ])
    <div class="d-lg-flex">
        <div class="chat-leftsidebar me-lg-4">
            <div class="">
                <div class="py-4 border-bottom">
                    <div class="d-flex">
                        <div class="flex-shrink-0 align-self-center me-3">
                            <img src="{{ asset('uploads/profile_photo') }}/{{ Auth::user()->profile_photo }}"
                                class="avatar-xs rounded-circle" alt="">
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="font-size-15 mb-1">{{ Auth::user()->first_name }} {{ Auth::user()->last_name ?? '' }}
                            </h5>
                            <p class="text-muted mb-0"><i class="mdi mdi-circle text-success align-middle me-1"></i> Active
                            </p>
                        </div>

                        <div>
                            <div class="dropdown chat-noti-dropdown">
                                <button class="btn" type="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="bx bx-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="search-box chat-search-box py-4">
                    <div class="position-relative">
                        <input type="text" class="form-control" placeholder="Search...">
                        <i class="bx bx-search-alt search-icon"></i>
                    </div>
                </div>

                <div class="chat-leftsidebar-nav">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a href="#chat" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                                <i class="bx bx-chat font-size-20 d-sm-none"></i>
                                <span class="d-none d-sm-block">Chat</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#groups" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="bx bx-group font-size-20 d-sm-none"></i>
                                <span class="d-none d-sm-block">Groups</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content py-4">
                        <div class="tab-pane show active" id="chat">
                            <div>
                                <h5 class="font-size-14 mb-3">Recent</h5>
                                <ul class="list-unstyled chat-list" data-simplebar style="max-height: 410px;">
                                    <li class="active">
                                        <a href="javascript: void(0);">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <i class="mdi mdi-circle font-size-10"></i>
                                                </div>
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <img src="{{ asset('assets/backend/images/users') }}/avatar-2.jpg"
                                                        class="rounded-circle avatar-xs" alt="">
                                                </div>

                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-14 mb-1">Steven Franklin</h5>
                                                    <p class="text-truncate mb-0">Hey! there I'm available</p>
                                                </div>
                                                <div class="font-size-11">05 min</div>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="javascript: void(0);">
                                            <div class="d-flex">
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <i class="mdi mdi-circle text-success font-size-10"></i>
                                                </div>
                                                <div class="flex-shrink-0 align-self-center me-3">
                                                    <img src="{{ asset('assets/backend/images/users') }}/avatar-3.jpg"
                                                        class="rounded-circle avatar-xs" alt="">
                                                </div>

                                                <div class="flex-grow-1 overflow-hidden">
                                                    <h5 class="text-truncate font-size-14 mb-1">Adam Miller</h5>
                                                    <p class="text-truncate mb-0">I've finished it! See you so</p>
                                                </div>
                                                <div class="font-size-11">12 min</div>
                                            </div>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>

                        <div class="tab-pane" id="groups">
                            <h5 class="font-size-14 mb-3">Groups</h5>
                            <ul class="list-unstyled chat-list" data-simplebar style="max-height: 410px;">
                                <li>
                                    <a href="javascript: void(0);">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-xs">
                                                    <span
                                                        class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                                        G
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="flex-grow-1">
                                                <h5 class="font-size-14 mb-0">General</h5>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                                <li>
                                    <a href="javascript: void(0);">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-xs">
                                                    <span
                                                        class="avatar-title rounded-circle bg-primary-subtle text-primary">
                                                        R
                                                    </span>
                                                </div>
                                            </div>

                                            <div class="flex-grow-1">
                                                <h5 class="font-size-14 mb-0">Reporting</h5>
                                            </div>
                                        </div>
                                    </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>


            </div>
        </div>
        <div class="w-100 user-chat">
            <div class="card">
                <div class="p-4 border-bottom ">
                    <div class="row">
                        <div class="col-md-4 col-9">
                            <h5 class="font-size-15 mb-1">Steven Franklin</h5>
                            <p class="text-muted mb-0"><i class="mdi mdi-circle text-success align-middle me-1"></i>
                                Active now</p>
                        </div>
                        <div class="col-md-8 col-3">
                            <ul class="list-inline user-chat-nav text-end mb-0">
                                <li class="list-inline-item">
                                    <div class="dropdown">
                                        <button class="btn nav-btn dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-horizontal-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <a class="dropdown-item" href="#">View Profile</a>
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>


                <div>
                    <div class="chat-conversation p-3">
                        <ul class="list-unstyled mb-0" data-simplebar style="max-height: 486px;">
                            <li>
                                <div class="chat-day-title">
                                    <span class="title">Today</span>
                                </div>
                            </li>
                            <li class="last-chat">
                                <div class="conversation-list">
                                    <div class="dropdown">

                                        <a class="dropdown-toggle" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </div>
                                    <div class="ctext-wrap">
                                        <div class="conversation-name">Steven Franklin</div>
                                        <p>& Next meeting tomorrow 10.00AM</p>
                                        <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> 10:06
                                        </p>
                                    </div>

                                </div>
                            </li>

                            <li class=" right">
                                <div class="conversation-list">
                                    <div class="dropdown">

                                        <a class="dropdown-toggle" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </a>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="#">Delete</a>
                                        </div>
                                    </div>
                                    <div class="ctext-wrap">
                                        <div class="conversation-name">Henry Wells</div>
                                        <p>
                                            Wow that's great
                                        </p>

                                        <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> 10:07
                                        </p>
                                    </div>
                                </div>
                            </li>


                        </ul>
                    </div>
                    <div class="p-3 chat-input-section">
                        <div class="row">
                            <div class="col">
                                <div class="position-relative">
                                    <input type="text" class="form-control chat-input" placeholder="Enter Message...">
                                    <div class="chat-input-links" id="tooltip-container">
                                        <ul class="list-inline mb-0">
                                            <li class="list-inline-item"><a href="javascript: void(0);" title="Emoji"><i
                                                        class="mdi mdi-emoticon-happy-outline"></i></a></li>
                                            <li class="list-inline-item"><a href="javascript: void(0);" title="Images"><i
                                                        class="mdi mdi-file-image-outline"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <button type="submit"
                                    class="btn btn-primary btn-rounded chat-send w-md waves-effect waves-light"><span
                                        class="d-none d-sm-inline-block me-2">Send</span> <i
                                        class="mdi mdi-send"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- end row -->
@endsection

@push('script')
@endpush
