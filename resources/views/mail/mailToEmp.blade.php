<p>Dear {{ $user->compName }},</p>
<p>I've found you are looking for a {{ $user->position_sec }} in the area of {{ $user->position_main }}, and it looks like a good oportunity for my next challenge!</p>
<p>If the position is still open, I would like to schedule an interview, if you're interested of course.</p>
<br>
<p>Looking forward to hear from you! If you need more information, don't hesistate contacting me at {{ $user->userEmail }}.</p>
<br>
<p>Sincerely,</p>
<p>{{ $user->userName }} {{ $user->userLastName }}</p>