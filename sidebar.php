<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

        <div class="col-lg-4">
           <div class="blog_right_sidebar">
              <aside class="single_sidebar_widget post_category_widget">
                 <h4 class="widget_title">Category</h4>
                 <ul class="list cat-list">
                  <?php
                    $categories = get_category_list();
                    foreach($categories as $category) {
                      echo '<li>
                         <a href="/category/'.$category["id"].'/'.preg_replace('/\s+/', '-', $category['name']).'" class="d-flex">
                            <p>' . $category['name'] . '</p>
                            <p>(' . get_project_count($category["id"]) . ')</p>
                         </a>
                      </li>';
                    }
                  ?>
                 </ul>
              </aside>
              <aside class="single_sidebar_widget popular_post_widget">
                 <h3 class="widget_title">Recent Post</h3>

                <?php
                  $projects = get_recent_projects();
                  foreach($projects as $project){
                    $id = $project['project_id'];
                    $title = preg_replace('/\s+/', '-', $project['title']);
                    $url = "/project/" . $id . "/" . $title;
                    echo '
                     <div class="media post_item">
                        <img src="' . $project['thumbnail'] . '" alt="post" height=100 width=150>
                        <div class="media-body">
                           <a href='.$url.'>
                              <h3>' . $project['title'] . '</h3>
                           </a>
                           <p>' . $project['created_at'] . '</p>
                        </div>
                      </div>';
                  }
                ?>
           </div>
        </div>
     </div>
  </div>
</section>