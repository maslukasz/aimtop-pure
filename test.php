<?php

?>

<body>
  <div class="tab-list" role="tablist">
    <button hx-get="benchmarks/vt4_controller.php" class="selected" role="tab" aria-selected="false" aria-controls="tab-content">Tab 1</button>
    <button hx-get="/test.php" role="tab" aria-selected="true" aria-controls="tab-content">Tab 2</button>
    <button hx-get="/tab3" role="tab" aria-selected="false" aria-controls="tab-content">Tab 3</button>
  </div>

  <div id="tab-content" role="tabpanel" class="tab-content">
    Commodo normcore truffaut VHS duis gluten-free keffiyeh iPhone taxidermy godard ramps anim pour-over.
    Pitchfork vegan mollit umami quinoa aute aliquip kinfolk eiusmod live-edge cardigan ipsum locavore.
    Polaroid duis occaecat narwhal small batch food truck.
    PBR&B venmo shaman small batch you probably haven't heard of them hot chicken readymade.
    Enim tousled cliche woke, typewriter single-origin coffee hella culpa.
    Art party readymade 90's, asymmetrical hell of fingerstache ipsum.
  </div>

</body>
require_once 'components/logic/vt.php';
