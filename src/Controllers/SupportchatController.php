<?php

namespace Aidaskni\Supportchat\Controllers;

use Aidaskni\Supportchat\Http\Requests\ConversationCreateRequest;
use Aidaskni\Supportchat\Models\Conversation;
use Aidaskni\Supportchat\Models\Message;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SupportchatController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $conversations = Conversation::whereNull('support_id')->get();
        return view('supportchat.chat-all-customers', compact('conversations'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('supportchat.chat-form');
    }

    /**
     * @param ConversationCreateRequest $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function store(ConversationCreateRequest $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $data['title'] = $data['name'];
            $data['client_id'] = null;
            $data['support_id'] = null;

            $conversation = Conversation::create($data);

            $conversation->messages()->create([
                'user_id' => 1,
                'conversation_id' => $conversation->id,
                'message_body' => $data['user-message'] ? $data['user-message'] : '',
            ]);

            return response()->json(['success' => true, 'message' => 'Request created !', 'ids' => $conversation->id, 'name' => $data['name']]);
        }

        return ['status' => 'OK'];
    }

    /**
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $id)
    {
        $support = Auth::user();
        $conversation = Conversation::find($id);
        $conversation->support_id = $support->id;
        $conversation->save();

        return view('supportchat.chat-conversation', compact('conversation', 'support'));
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function getMessagesById(int $id)
    {
        $messages = Message::where('conversation_id', '=', $id)->with('user')->get();
        return $messages;
    }

    /**
     * @param int $id
     * @return array
     */
    public function sendMessage(int $id)
    {
        $user = Auth::user();
        $conversation = Conversation::find($id);
        $message = Message::create([
            'conversation_id' => $conversation->id,
            'user_id' => 1,
            'message_body' => request()->get('message_body') ? request()->get('message_body') : ''
        ]);

        broadcast(new \App\Events\SupportMessageEvent($conversation, $message, $user))->toOthers();

        return ['status' => 'OK'];
    }

    public function clearMessages(int $id)
    {
        $conversation = Conversation::find($id);
        Message::where('conversation_id', '=', $id)->delete();
        broadcast(new \App\Events\ClearMessagesEvent($conversation));

        return redirect()->route('conversations.show', $id);
    }
}

