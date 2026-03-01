<?php

namespace App\Http\Controllers;

use App\Mail\InvitationNotification;
use App\Models\Colocations;
use Illuminate\Http\Request;
use App\Models\Invitation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class InvitationController extends Controller
{

    public function create($colocationId)
    {
        $colocation = Colocations::findOrFail($colocationId);
        return view('members.create', compact('colocation'));
    }


    public function sendInvitation(Request $request, $colocationId)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $colocation = Colocations::findOrFail($colocationId);
        $token = Str::random(32);

        $invitation = Invitation::create([
            'colocation_id' => $colocationId,
            'email' => $request->email,
            'token' => $token,
        ]);

        $inviteUrl = route('invitations.join', ['token' => $token]);


        Mail::to($request->email)->send(new InvitationNotification($inviteUrl));

        return redirect()->route('members.create', $colocationId)
            ->with('success', "Invitation envoyée !")
            ->with('invite_url', $inviteUrl);
    }

    public function join($token)
    {
        // dd($token);
        $invitation = Invitation::where('token', $token)->firstOrFail();
        $colocation = Colocations::findOrFail($invitation->colocation_id)->firstOrFail();
        //  dd($invitation);
        if ($invitation->accepted) {
            return redirect()->route('dashboard')->with('error', 'Invitation déjà acceptée.');
        }
        return view('invitations.show', compact('colocation', 'invitation'));
    }

    public function accept(Request $request, $token)
    {
        // dd($token);
        $invitation = Invitation::where('token', $token)->firstOrFail();
        $user = auth()->user();

        $hasActiveColocation = $user->colocations()->where('status', 'active')->exists();
        $alreadyMember = $user->colocations()->where('colocations.id', $invitation->colocation_id)->exists();


        if ($alreadyMember) {
            return redirect()->route('invitations.join', $token)
                ->with('error', 'Vous êtes déjà membre de cette colocation !');
        }

        if ($hasActiveColocation) {
            return redirect()->route('invitations.join', $token)
                ->with('error', 'Vous avez déjà une colocation active !');
        } else {

            $user->colocations()->attach($invitation->colocation_id, [
                'role' => 'member',
                'joined_at' => now(),
            ]);
            $invitation->update([
                "accepted" => 1,
            ]);

            return redirect()->route('colocations.show', $invitation->colocation_id)
                ->with('msg', 'Vous avez rejoint la colocation !');
        }
    }
}
