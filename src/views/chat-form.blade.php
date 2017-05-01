<div id="chat-start-form-container">
    <div id="hide">
        <span class="hide-minus glyphicon glyphicon-minus"></span>
    </div>
        <form id="chat-start-form" method="post" action="{{route('conversations.create')}}">
            <div class="form-group">
                <label for="name" class="col-2 col-form-label">Name</label>
                <div class="col-10">
                    <input class="form-control" type="text" placeholder="Name" id="name" name="name">
                </div>
            </div>
            <div class="form-group">
                <label for="email" class="col-2 col-form-label">Email</label>
                <div class="col-10">
                    <input class="form-control" type="email" placeholder="email@domain.com" id="email" name="email">
                </div>
            </div>
            <div class="form-group">
                <label for="user-message">Message</label>
                <textarea class="form-control" id="user-message" name="user-message" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

        @include('supportchat.chat-client-form')
</div>

