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
        <!-- Chat Sidebar -->
        <div class="chat-leftsidebar me-lg-4">
            <div class="">
                <!-- User Info -->
                <div class="py-4 border-bottom">
                    <div class="d-flex">
                        <div class="flex-shrink-0 align-self-center me-3">
                            <img src="{{ asset('uploads/profile_photo') }}/{{ Auth::user()->profile_photo }}"
                                class="avatar-xs rounded-circle" alt="">
                        </div>
                        <div class="flex-grow-1">
                            <h5 class="font-size-15 mb-1">{{ Auth::user()->first_name }} {{ Auth::user()->last_name ?? '' }}
                            </h5>
                            <p class="text-muted mb-0">
                                <i
                                    class="mdi mdi-circle {{ Auth::user()->socket_id ? 'text-success' : '' }} align-middle me-1"></i>
                                {{ Auth::user()->socket_id ? 'Active' : 'Inactive' }}
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Search Box -->
                <div class="search-box chat-search-box py-4">
                    <div class="position-relative">
                        <input type="text" class="form-control" id="search-chat" placeholder="Search...">
                        <i class="bx bx-search-alt search-icon"></i>
                    </div>
                </div>

                <!-- Chat List -->
                <div class="chat-leftsidebar-nav">
                    <ul class="nav nav-pills nav-justified">
                        <li class="nav-item">
                            <a href="#chat" data-bs-toggle="tab" class="nav-link active">
                                <i class="bx bx-chat font-size-20 d-sm-none"></i>
                                <span class="d-none d-sm-block">Chat</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#groups" data-bs-toggle="tab" class="nav-link">
                                <i class="bx bx-group font-size-20 d-sm-none"></i>
                                <span class="d-none d-sm-block">Groups</span>
                            </a>
                        </li>
                    </ul>

                    <div class="tab-content py-4">
                        <!-- Chat Tab -->
                        <div class="tab-pane show active" id="chat">
                            <div>
                                <h5 class="font-size-14 mb-3">Recent</h5>
                                <ul class="list-unstyled chat-list" id="chat-list" data-simplebar
                                    style="max-height: 410px;">
                                    @foreach ($chatlist as $key => $list)
                                        <li class="user-chat-item" data-receiver-id="{{ $list->receiver->id }}">
                                            <a href="javascript:void(0);">
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 align-self-center me-3">
                                                        <img src="{{ asset('uploads/profile_photo') }}/{{ $list->receiver->profile_photo }}"
                                                            class="rounded-circle avatar-xs" alt="">
                                                    </div>
                                                    <div class="flex-grow-1 overflow-hidden">
                                                        <h5 class="text-truncate font-size-14 mb-1">
                                                            {{ $list->receiver->first_name }}
                                                            {{ $list->receiver->last_name }}
                                                        </h5>
                                                        <p class="text-truncate mb-0">Click to chat</p>
                                                    </div>
                                                </div>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <!-- Groups Tab -->
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
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chat Content -->
        <div class="w-100 user-chat">
            <div class="card">
                <div class="p-4 border-bottom">
                    <div class="row">
                        <div class="col-md-4 col-9">
                            <h5 class="font-size-15 mb-1" id="chat-title">Select a User</h5>
                            <p class="text-muted mb-0" id="chat-status">...</p>
                        </div>
                    </div>
                </div>
                <div class="chat-conversation p-3">
                    <ul class="list-unstyled mb-0" id="chat-messages" data-simplebar style="max-height: 486px;">
                        <li class="text-center text-muted no-conversation">
                            <p>Select a user to start a conversation.</p>
                        </li>
                    </ul>
                </div>
                <form action="{{ route('admin.chat_submit') }}" method="POST" id="sendform">
                    @csrf
                    <input type="hidden" name="receiver_id" id="receiver_id">
                    <div class="p-3 chat-input-section">
                        <div class="row">
                            <div class="col">
                                <div class="position-relative">
                                    <input type="text" class="form-control chat-input" name="message"
                                        placeholder="Enter Message..." id="send_message">
                                </div>
                            </div>
                            <div class="col-auto">
                                <button type="submit" id="submit"
                                    class="btn btn-primary btn-rounded chat-send w-md waves-effect waves-light">
                                    <span class="d-none d-sm-inline-block me-2">Send</span>
                                    <i class="mdi mdi-send"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.socket.io/4.0.0/socket.io.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        const socket = io('http://127.0.0.1:3000');
        const userId = {{ Auth::user()->id }};

        // handle socket connection
        socket.on('connect', () => {
            const socketId = socket.id;
            saveSocketIdToUserTable(userId, socketId);
        });

        // handle socket disconnection
        socket.on('disconnect', () => {
            const socketId = socket.id;
            deleteSocketIdFromUserTable(userId, socketId);
        });

        // emit user connected
        socket.emit("user_connected", userId);

        // save socketId
        const saveSocketIdToUserTable = async (userId, socketId) => {
            try {
                const response = await axios.post('{{ route('admin.update_socketId') }}', {
                    user_id: userId,
                    socket_id: socketId
                });
            } catch (error) {
                console.error(error.message);
            }
        };

        // delete socketId
        const deleteSocketIdFromUserTable = async (userId, socketId) => {
            try {
                const response = await axios.post('{{ route('admin.delete_socketId') }}', {
                    user_id: userId,
                    socket_id: socketId,
                });
            } catch (error) {
                console.error(error.message);
            }
        };

        $(document).on('click', '.user-chat-item', function() {
            let receiverId = $(this).data('receiver-id');

            $('.user-chat-item').removeClass('active');
            $(this).addClass('active');

            $.ajax({
                url: "{{ route('admin.chat.getMessages', ['receiverId' => '__receiverId__']) }}".replace('__receiverId__', receiverId),
                type: 'GET',
                success: function(response) {
                    let messages = response.messages;
                    let chatHtml = '';

                    messages.forEach(message => {
                        if (message.sender_id == {{ Auth::id() }}) {
                            chatHtml += `
                                <li class="right">
                                    <div class="conversation-list">
                                        <div class="ctext-wrap">
                                            <div class="conversation-name">You</div>
                                            <p>${message.message}</p>
                                            <p class="chat-time mb-0">
                                                <i class="bx bx-time-five align-middle me-1"></i>
                                                ${new Date(message.created_at).toLocaleTimeString()}
                                            </p>
                                        </div>
                                    </div>
                                </li>`;
                        } else {
                            chatHtml += `
                                <li class="left">
                                    <div class="conversation-list">
                                        <div class="ctext-wrap">
                                            <div class="conversation-name">${message.sender_name}</div>
                                            <p>${message.message}</p>
                                            <p class="chat-time mb-0">
                                                <i class="bx bx-time-five align-middle me-1"></i>
                                                ${new Date(message.created_at).toLocaleTimeString()}
                                            </p>
                                        </div>
                                    </div>
                                </li>`;
                        }
                    });

                    $('#chat-messages').html(chatHtml);
                    $('#receiver_id').val(receiverId);
                    $('#chat-title').text(response.receiverName);
                }
            });
        });

        $(document).on('click', '#submit', function(e) {
            e.preventDefault();
            let message = $('#send_message').val().trim();
            let receiverId = $('#receiver_id').val();
            let senderId = {{ Auth::user()->id }};

            if (!receiverId || !message) {
                alert("Please select a user and enter a message.");
                return;
            }

            $.ajax({
                url: "{{ route('admin.chat_submit') }}",
                type: 'POST',
                data: {
                    sender_id: senderId,
                    receiver_id: receiverId,
                    message: message,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    socket.emit('message', {
                        receiverId: receiverId,
                        message: message,
                        senderId: senderId
                    });

                    $('#send_message').val('');
                    $('#chat-messages').append(`
                        <li class="right">
                            <div class="conversation-list">
                                <div class="ctext-wrap">
                                    <div class="conversation-name">You</div>
                                    <p>${message}</p>
                                    <p class="chat-time mb-0">
                                        <i class="bx bx-time-five align-middle me-1"></i>
                                        ${new Date().toLocaleTimeString()}
                                    </p>
                                </div>
                            </div>
                        </li>
                    `);
                }
            });
        });

        socket.on('msg', function(msg) {
            const newMessageHtml = `
                <li class="left">
                    <div class="conversation-list">
                        <div class="ctext-wrap">
                            <div class="conversation-name">${msg.senderName}</div>
                            <p>${msg.message}</p>
                            <p class="chat-time mb-0">
                                <i class="bx bx-time-five align-middle me-1"></i>
                                ${msg.createdAt}
                            </p>
                        </div>
                    </div>
                </li>
            `;
            $('#chat-messages').append(newMessageHtml);
        });
    </script>
@endpush
