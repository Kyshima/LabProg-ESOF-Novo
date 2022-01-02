<p>Dear {{ $user->userName }} {{ $user->userLastName }},</p>
<p>Here at {{ $user->compName }}, while we were conducting some research for the position of {{$user->position_sec}} in the area of {{$user->position_main}} , we came across your profile. </p>
<p>Based on your curriculum, we would like to schedule an interview with you if you're interested.</p>

<p>If you need more information, you can contact us at {{$user->compEmail}}</p>
<br>
<p>Sincerely,</p>
<p>{{ $user->compName }}</p>
