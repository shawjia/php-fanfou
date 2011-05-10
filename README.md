# Fanfou PHP library(饭否 PHP 库)
## 目前支持接口
### get
- verify()
- getHome($count = NULL, $page = NULL, $since_id = NULL, $max_id = NULL, $format = 'html')
- getMentions($count = NULL, $page = NULL, $since_id = NULL, $max_id = NULL, $format = 'html')
- getInDMs($count = NULL, $page = NULL, $since_id = NULL, $max_id = NULL)
- getOutDMs($count = NULL, $page = NULL, $since_id = NULL, $max_id = NULL)
- getUserInfo($id=NULL)
- getUserTimeline($id = NULL, $count = NULL, $page = NULL, $since_id = NULL, $max_id = NULL, $format = 'html')
- getStatus($status_id, $format='html')

### post
- update($status, $in_reply_to_status_id=NULL, $repost_status_id=NULL, $location=NULL)
- delete($status_id)
- fav($status_id)
- unfav($status_id)
- sentDM($user, $text, $in_reply_to_id=NULL)
- deleteDM($dm_id)
