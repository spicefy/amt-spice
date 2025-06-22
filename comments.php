<?php
if (post_password_required()) {
  return;
}
?>

<!-- Post Comments -->
<section class="container mb-4 pt-lg-4 pb-lg-3">
  <h2 class="h1 text-center text-sm-start"><?php comments_number( 'No comments yet', '1 comment', '% comments' ); ?></h2>
  <div class="row">

    <!-- Comments Section -->
    <div class="col-lg-9">

      <!-- Check if there are comments and display them -->
      <?php
      if (have_comments()) :
        // Loop through the comments
        wp_list_comments([
          'style'       => 'div',
          'short_ping'  => true,
          'avatar_size' => 48,
          'callback'    => 'amt_spice_comments_display', // Custom callback function
        ]);
      else :
        echo '<p>No comments yet.</p>';
      endif;

      // Pagination for comments
      the_comments_pagination([
        'prev_text' => '&larr; Older Comments',
        'next_text' => 'Newer Comments &rarr;',
      ]);
      ?>

      <!-- Comment Form -->
      <?php
      if (comments_open()) :
        ?>
        <div class="card p-md-5 p-4 border-0 bg-secondary">
          <div class="card-body w-100 mx-auto px-0" style="max-width: 746px;">
          <h2 class="mb-4 pb-3">Leave a Comment</h2>
            <?php
            // Removing the "Leave a Comment" title from the comment form
            // 'title_reply' is the default title; removing it here so it's not shown again
            comment_form([
              'title_reply' => '',  // Remove "Leave a Comment"
              'class_form'  => 'row gy-4 needs-validation',
              'class_submit' => 'btn btn-lg btn-primary w-sm-auto w-100 mt-2',
              'fields' => [
                'author' =>
                  '<div class="col-sm-6 col-12">
                    <label for="c-name" class="form-label fs-base">Name</label>
                    <input id="c-name" name="author" type="text" class="form-control form-control-lg" value="' . esc_attr($commenter['comment_author']) . '" ' . ($req ? 'required' : '') . '>
                    <span class="invalid-tooltip">Please, enter your name.</span>
                  </div>',

                'email' =>
                  '<div class="col-sm-6 col-12">
                    <label for="c-email" class="form-label fs-base">Email</label>
                    <input id="c-email" name="email" type="email" class="form-control form-control-lg" value="' . esc_attr($commenter['comment_author_email']) . '" ' . ($req ? 'required' : '') . '>
                    <span class="invalid-tooltip">Please, provide a valid email address.</span>
                  </div>',
              ],
              'comment_field' =>
                '<div class="col-12">
                  <label for="c-comment" class="form-label fs-base">Comment</label>
                  <textarea id="c-comment" name="comment" class="form-control form-control-lg" rows="3" placeholder="Type your comment here..." required></textarea>
                  <span class="invalid-tooltip">Please, enter your comment.</span>
                </div>',
              'submit_field' =>
                '<div class="col-12">
                  %1$s %2$s
                </div>',
              'logged_in_as' => '',
              'comment_notes_before' => '',
              'comment_notes_after' =>
                '', // Remove the comment notes section completely
            ]);
            ?>
          </div>
        </div>
      <?php else : ?>
        <p>Comments are closed for this post.</p>
      <?php endif; ?>

    </div>
  </div>
</section>

<!-- End Post Comments -->
