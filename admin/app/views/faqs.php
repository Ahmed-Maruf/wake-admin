<?php
	//include 'layouts/header.layout.php';
	require_once 'layouts/header.layout.php';
	include "layouts/sidebar.layout.php";
?>


<div class="pusher" style="max-width: 70%; margin-left: 1em;">
    <div class="ui vertical segment">
        <div class="ui grid" >
            <div class="row">
                <div class="sixteen wide column">

                    <div class="ui segment">
                        <form class="ui form" id="addfaq">
                            <div class="field">
                                <label>Question</label>
                                <input type="text" name="q" id="q">
                            </div>
                            <div class="field">
                                <label>Answer</label>
                                <input type="text" name="a" id="a">
                            </div>
                            <div class="ui positive button" id="addToDb">Add</div>
                        </form>
                    </div>

                    <div class="ui segment">
                        <form class="ui form" id="existingfaq">
                            <?php
                            $ind = 1;
                            $c = '';
                            foreach ($datas as $faq){
                                $c .= '<div class="fields">';
                                $c .= '<div class="eight wide field">';
                                $c .= '<input name="q'.$ind.'" id="q'.$ind.'" type="text" value="'.str_replace( '"', '',$faq->question).'">';
                                $c .= '</div><div class="eight wide field">';
                                $c .= '<input name="a'.$ind.'" id="a'.$ind.'" type="text" value="'.str_replace( '"', '',$faq->answer).'">';
                                $c .= '</div>';
                                $c .= '</div>';
                                $ind++;
                            }
                            echo $c
                            ?>
                            <div class="ui positive button" id="updatefaq">Update</div>
                            <div class="ui positive button" id="deleteFAQ">Delete Bottom FAQ</i></div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<?php
	require 'layouts/footer.layout.php';
?>