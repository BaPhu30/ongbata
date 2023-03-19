<?php  
 //fetch.php  
include '../connectserve/connect.php';
 if(isset($_POST["membersid"]))  
 {  
      $query = "SELECT * FROM ftree_v1_4_members WHERE id = '".$_POST["membersid"]."'";  
      $result = mysqli_query($connect, $query);  
      while ($row = mysqli_fetch_array($result)) {
           $data = $row['bio'];
      }
 }
 ?>
<div class="container_story_dad">
    <div class="toolbar-container_story">

    </div>
    <div class="form-control textarea-control    border border-0 position-relative editor_story" rows="10"
        name="textcontent">
        <?php echo $data ?>
    </div>
</div>
<script>
$(document).on('click', '#Update_story_p', function(e) {
        let textcontent = Update_story.getData();
        var memberid =' <?php echo $_POST["membersid"] ?>';
        var name =  '<?php echo $_POST["name"] ?>';
        e.preventDefault();
        $('<?php echo $_POST['data_id_person']?>').html(textcontent);
        $("#Update_story").modal('hide');
        $.post("../Process/edit_information.php?edit_infor",
            {
                memberid: memberid,
                name: name,
                data: textcontent
            });
});
</script>
<script>
DecoupledEditor

    .create(document.querySelector('.editor_story'), {
        placeholder: 'Bạn đang nghĩ gì?'
    })

    .then(Update_story => {
        const toolbarContainer = document.querySelector('.container_story_dad .toolbar-container_story');

        toolbarContainer.prepend(Update_story.ui.view.toolbar.element);

        window.Update_story = Update_story;
    })
    .catch(err => {
        console.error(err.stack);
    });
</script>