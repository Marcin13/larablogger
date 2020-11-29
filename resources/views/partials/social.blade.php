{!! Share::page(route('posts.single',$post->slug), 'Share title')
->facebook()
->twitter()
->linkedin('Extra linkedin summary can be passed here')
->reddit()
!!}
