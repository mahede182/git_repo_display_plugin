<?php
/*
 wordprss git repos class
*/
class WP_repos_git extends WP_Widget{


    // construction
   public function __construct(){
        parent::__construct(
            'my_repos_git',
            __('My git repository','repos_git_domain'),
           __('A simple git repository','repos_git_domain') 
        );
    }


    // for frontend
    public function widget($args,$instance)
    {

        $title = apply_filters( 'widget_title', $instance['title'] );
        $username = esc_attr($instance['username']);
        $count = esc_attr($instance['count']);
        
        echo $args['before_widget'];

        if(!empty($title)){
            echo $args['before_title'].$title.$args['after_title'];
        }
        echo $this->showRepos($title,$username,$count);
        echo $args['after_widget'];

    }


    // for backend
    public function form($instance)
    {   
        // get the title
        if(isset($instance['title'])){
            $title = $instance['title'];
        }else {
            $title = __('Latest github repository','repos_git_domain');
        }
        
        // get the username
        if(isset($instance['username'])){
            $username = $instance['username'];
        }
        else{
            $username = __('Mahede','repos_git_domain');
        }
        // get count
        if(isset($instance['count'])){
            $count = $instance['count'];
        }
        else{
            $count = 5;
        }
       ?>
       <p>
       <label for="<?php echo $this->get_field_id('title');?>"><?php _e('Title');?></label>
       <input type="text" 
              class="widefat" 
              name="<?php echo $this->get_field_name('title');?>" 
              id="<?php echo $this->get_field_id('title');?>" 
              value="<?php echo esc_attr($title);?>">
       </p>

       <p>
       <label for="<?php echo $this->get_field_id('username');?>"><?php _e('username','repos_git_domain');?></label>
       <input type="text"
              class="widefat"
              name="<?php echo $this->get_field_name('username');?>" 
              id="<?php echo $this->get_field_id('username');?>" 
              value="<?php echo esc_attr($username);?>">
       </p>

       <p>
       <label for="<?php echo $this->get_field_id('count');?>"><?php _e('count','repos_git_domain');?></label>
       <input type="text" 
              class="widefat" 
              name="<?php echo $this->get_field_name('count');?>" 
              id="<?php echo $this->get_field_id('count');?>" 
              value="<?php echo esc_attr($count);?>">
       </p>


       <?php
    }


    // update the widget
    // public function update($new_instance,$old_instance)
    // {
    // $instance = array();

    // // $instance['title'] = (!empty($new_instance['title']))?strip_tags($new_instance['title']):'';
    // $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']):'';
    // $instance['username'] = (!empty($new_instance['username']))?strip_tags($new_instance['username']):'';
    // $instance['count'] = (!empty($new_instance['count']))?strip_tags($new_instance['count']):'';
        
    //     return $instance;
    // }

    public function update($new_instance,$old_instance){
        // processes widget options to be saved
        $instance = array();

        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']):'';
        $instance['username'] = (!empty($new_instance['username'])) ? strip_tags($new_instance['username']):'';
        $instance['count'] = (!empty($new_instance['count'])) ? strip_tags($new_instance['count']):'';

        return $instance;
    }

    public function showRepos($title,$username,$count)
    {
         $url = 'https://api.github.com/users/'.$username.'/repos?sort=created&per_page='.$count;
        // $url = 'https://api.github.com/users/mahede182/repos?sort=created&per_page=5';
        // $options = array('http' => array('user_agent' => $_SERVER['HTTP_USER_AGENT']));
        // $context = stream_context_create($option);
        // $response = file_get_contents($url,false,$context);


        // OH! so thanks stack overflow ;););)
            $opts = [
                'http' => [
                        'method' => 'GET',
                        'header' => [
                                'User-Agent: PHP'
                        ]
                ]
        ];
        
        $context = stream_context_create($opts);
        $response = file_get_contents($url, false, $context);


        $repos = json_decode( $response);
        // output are show here

        $output = '<ul class="repos">';

        foreach($repos as $repo){
            $output .= '<li>
                            <div class="repo-title">'.$repo->name.'</div>
                            <div class="repo-desc">'.$repo->description.'</div>
                            <a target="_blank" href=".$repo->html_url."> view on Github</a>
                            </li>';
        }
        $output .= '</ul>';

        return $output;
    }




















}//$this is the WP_repos_git classes right curly.
?>