<?php

// resources/lang/en/messages.php

return [
  'nav_step_1' => '1. Read General Information',
  'nav_step_2' => '2. Indicate Seminar Wishes',
  'nav_step_3' => '3. Submit Ranking List',

  /*--------------------------*/

  'footer_text_help' => 'Questions, help oder issues to zewkursm@mail.uni-mannheim.de',
  'footer_text_copyright' => '© 2018, Marktdesign @ ZEW <br> <a href="https://www.uni-mannheim.de/impressum/" style="color: #fff">Imprint</a> & <a href="https://www.uni-mannheim.de/datenschutzerklaerung/" style="color: #fff">Privacy Statement</a>',

  /*--------------------------*/

  'intro_title' => 'Allocation of Seminar Places at the Mannheim Department of Economics, Spring Semester 2019',
  'intro_text_1' => 'On this website you can choose the <b>bachelor seminars (and seminar combinations) that you would like to attend in spring 2019</b>, and rank them according to your preferences. <br><br> We will then use a version of the well-known Gale-Shapley algorithm to allocate you, the students, to available seminar capacities. For more information on the algorithm, see below or read the Wikipedia articles on the <a href="https://en.wikipedia.org/wiki/Stable_marriage_problem">stable marriage problem</a> and on the application of this algorithm to the allocation of graduates from <a href="https://en.wikipedia.org/wiki/National_Resident_Matching_Program#Matching_algorithm">medical school to hospitals</a> in the U.S.',
  'intro_text_2' => 'In order to make this work, please read and follow the instructions on the following pages very carefully. You can find a detailed description, including prerequisites, of all seminars that are offered next semester in the <a target="_blank" rel="noopener noreferrer" href="https://www.vwl.uni-mannheim.de/studium/bachelorstudium/vorlesungsverzeichnis/">course catalogue</a>. Should there be any questions on using this allocation application, please do not hesitate to contact us at <a href="mailto:zewkursm@mail.uni-mannheim.de">zewkursm@mail.uni-mannheim.de</a>. For any question concerning the seminars, please address the respective contact person of the seminar (see course catalog).',
  'intro_text_3' => 'The version of the algorithm that we employ has certain properties that make it a good choice for the problem at hand. Most importantly, the mechanism is <b>strategyproof</b>, meaning that it is a weakly dominant strategy to submit your true preferences. In other words, you do not have to worry about whether you should rank a very popular seminar first or not. If a particular seminar is your top favourite, you can safely rank it first without harming your chances of admission to any of your other choices. <br><br> Second, the mechanism produces a <b>fair allocation</b> by taking into account the preferences of students and seminar organizers. This means that if you are not admitted to your top choice, all other students who are admitted to that seminar had a higher priority than yours. <br><br> Third, we make sure that students who plan to attend two seminars A and B in combination can only do so if there is no other student who would be willing to attend these two seminars separately. This is to ensure that <b>as many students as possible</b> can attend at least one seminar.',
  'intro_action_leave' => 'I do not want to attend a seminar next semester (you exit the app)',
  'intro_action' => 'Continue as student :aid',

  /*--------------------------*/

  'preferences_title' => '1. How many seminars are you planning to attend?',

  'preferences_manual_text_1' => 'Do you consider attending two seminars during the next semester? (e.g. you would like to attend both `Econometrics of Antitrust` and `Behavioral Public Economics` during the next semester)',
  'preferences_manual_text_2_single' => 'You are planning to attend one seminar during the next semester. In the following, you can add the seminars that you find interesting to a list. You can order this list according to your personal preferences below in Step 3.
    <br><br>
    <b id="ir" name="ir">Important remarks</b>:
    <ul>
    <li> You will not be assigned to seminars that you do not rank. </li>
	<li> Ranking only very few seminars does not increase your chances of getting into them &dash; on the contrary, in doing so you risk not being assigned to any seminar at all. </li>
	<li>It is in your best interest to rank your top choice first.</li>
	</ul>
If you rank a seminar and you are assigned to it, you are obliged to take it for credit.',
  'preferences_manual_text_2_couple' => '
  You indicated that you are considering to attend two seminars during the next semester. In the following, you can add all the combinations of seminars that you would be interested in taking next semester. You can (and you should) also add single seminars if you would be willing to take them individually. You can order them according to your personal preferences below in Step 3.
  <br>
  <p>
    <a class="btn btn-outline-primary" data-toggle="collapse" href="#collapseDetailed" role="button" aria-expanded="false" aria-controls="collapseDetailed">
      Understand a concrete example
    </a>
  </p>
  <div class="collapse" id="collapseDetailed">
    <div class="card card-body">
  <b>Example</b>
  If you are interested in taking the seminar in Game Theory together with either the seminar in Finance or E-commerce you should add the combinations
<ul type="none">
<li> Seminar 1: Game Theory <i>and</i> Seminar 2: Finance </li>
<li> Seminar 1: Game Theory <i>and</i> Semianr 2: E-commerce </li>
</ul>
to your list. If, in addition, you would also be willing to attend a seminar in Macroeconomics on its own, then you should add
<ul type="none">
<li> Seminar 1: Macroeconomics <i>and</i> Seminar 2: --- </li>
</ul>
to the list. By default, we will also add to the list all seminars that are part of a combination. E.g., in the above example, Game Theory, Finance and E-commerce would all be added to your list of consideration as single seminars. If you are not interested in taking any of these single seminars on their own, you can delete them in the step below. <b>You should only delete these courses if you would prefer to not attend any seminar rather than attending such a single seminar on its own.</b>
</div>
<br>
</div>
<b id="ir" name="ir">Important remarks</b>
<ul>
<li> You will not be assigned to seminars that you do not rank. </li>
<li> You should add single seminars to the list unless you really do not want to attend a single seminar on its own.
<li> Ranking only very few seminars or combinations does not increase your chances of getting into them &dash; on the contrary, in doing so you risk not being assigned to any seminar at all. </li>
<li>It is in your best interest to rank your top choice first (no matter whether this is a single seminar or a combination).</li>
</ul>
If you rank a combination of seminars and you are assigned to it, you are obliged to take both seminars for credit.
',
  'preferences_manual_text_3_single' => 'Rank all the seminars that you selected in the previous step. Our mechanism will try to assign you to your most preferred options.
<br><br>
For example, if you chose game theory, finance and e-commerce, you could choose the following ranking:
<div style="text-indent:10px;">
1) Game theory
</div>
<div style="text-indent:10px;">
2) Finance
</div>
<div style="text-indent:10px;">
3) E-commerce
</div>
<br>
This reads as follows: 1) You would like to take game theory. 2) If this is not possible you would like to take the finance seminar. 3) If this is also not possible, you would like to attend the seminar in e-commerce. <b>All other courses or combinations are out of consideration.</b>',
  'preferences_manual_text_3_couple' => 'Rank all the (combinations of) seminars that you selected in the previous step. Our mechanism will try to assign you to your most preferred options.
<br><br>
For example, if you chose game theory, finance and e-commerce, you could choose the following ranking:
<div style="text-indent:10px;">
1) Game theory & Finance
</div>
<div style="text-indent:10px;">
2) Game theory (alone)
</div>
<div style="text-indent:10px;">
3) Game theory & E-commerce
</div>
<br>
This reads as follows: 1) You would like to take game theory and finance at the same time. 2) If this is not possible you would like to take Game theory alone. 3) If this is also not possible, you accept it in combination with e-commerce. <i>All other courses or combinations are out of consideration.</i>',

  'preference_select_onetwo_label' => '',
  'preference_select_onetwo_1' => 'No',
  'preference_select_onetwo_2' => 'Yes',

  'preferences_add_title' => '2. Which seminars do you want to take?',
  'preferences_add_select_1_label' => 'Seminar:',
  'preferences_add_select_2_label' => 'In combination with:',

  'preferences_add_note_few_prefs' => '',
  'preferences_add_action_zero' => 'Add preference',
  'preferences_add_action' => 'Add next preference',
  'preferences_add_action_all' => 'All programs selected.',

  'preferences_show_title' => '3. Order your preferences:',
  'preferences_show_note_min_prefs' => 'Note: we recommend to list at least 3 seminars.',
  'preferences_show_note_privacy' => 'Note: The ranking list is only used to prioritize the seminars for you. The seminar managers cannot see your ranking.',
  'preferences_show_next_pref' => 'enter next seminar (combination)',
  'preferences_show_no_pref' => 'Please indicate your preferences about seminars you would like to take in the VWL department next semester.',

  'preferences_action_submit' => 'Submit your preferences bindingly.',
  'preferences_action_submit_note' => 'You can still return until the 12.12.2018 and edit your preferences at any time.',

  'preferences_errors_duplicate' => 'You have already submitted this selection. Please check your list of seminars.',

  /*--------------------------*/

  'preferences_submitted_title' => 'Your seminar wishes have been successfully submitted.',
  'preferences_submitted_text_1' => 'In the next days, you will receive an email informing you of the final allocation of seminars.',
  'preferences_submitted_text_2' => 'Note that you can return back and change your selection at any time up to 12.12.2018 23:59 CET.',
  'preferences_submitted_text_3' => 'In case you have any doubts, do not hesitate to contact us at <a href="mailto:zewkursm@mail.uni-mannheim.de">zewkursm@mail.uni-mannheim.de</a>.
  <br><br>
  Thank you.',

  /*--------------------------*/

  'activate_title' => 'Please tell us your activation code',
  'activate_text' => '',
  'activate_form_label' => 'Activation Code:',
  'activate_action' => 'Submit',
  /*'' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',*/
];
