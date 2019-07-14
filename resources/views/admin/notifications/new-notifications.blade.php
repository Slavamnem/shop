
    <li>
        <div class="notification-title" style="background-color: red"> Новое уведомление!</div>
        <div class="notification-list">
            <div class="list-group">
                @foreach($notifications as $notification)
                    <a href="{{route('admin-notifications-show', ['id' => $notification->id])}}" class="notification-list-group-item list-group-item list-group-item-action active" style="background-color: gold">
                        <div class="notification-info">
                            <div class="notification-list-user-img"><img src="assets/images/avatar-2.jpg" alt="" class="user-avatar-md rounded-circle"></div>
                            <div class="notification-list-user-block">
                                <span class="notification-list-user-name">{{$notification->preview}}</span>
                                <span style="color:{{$notification->priority->color}}; font-size:12px; font-family:Circular Std Medium">({{$notification->priority->name}})</span>
                                <div class="notification-date">{{$notification->created_at}}</div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </li>
    {{--<li>--}}
        {{--<div class="list-footer"> <a href="{{route('admin-notifications')}}">View all notifications</a></div>--}}
    {{--</li>--}}
