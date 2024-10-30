jQuery(document).ready(function($){
   var FeedUrl = FeedUrl;
   var MaxCount = MaxCount;
   $('#divRss').wpRssMediamaster({
   FeedUrl :  FeedUrl,
   MaxCount : MaxCount,
   ShowDesc : true,
   ShowPubDate: true
  });
  
});

