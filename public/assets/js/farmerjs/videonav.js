
   function redirectToPage(videoId) {
      // You can replace the following line with the actual URL you want to navigate to.
      var destinationUrl = '/video/view/' + videoId;

      // Redirect to the desired page
      window.location.href = destinationUrl;
   }


   function redirectTonewsvideo(videoId) {
      // You can replace the following line with the actual URL you want to navigate to.
      var destinationUrl = '/viewvideonew/' + videoId;

      // Redirect to the desired page
      window.location.href = destinationUrl;
   }

   function redirectTovnPage(videoId) {
      // You can replace the following line with the actual URL you want to navigate to.
      var destinationUrl = '/view/video/news/' + videoId;

      // Redirect to the desired page
      window.location.href = destinationUrl;
   }

   function redirectToVlearnPage(videoId) {
      // You can replace the following line with the actual URL you want to navigate to.
      var destinationUrl = '/video/tutorials/' + videoId;

      // Redirect to the desired page
      window.location.href = destinationUrl;
   }

   function redirectToSubVdetail(courseID,videoId) {
      // You can replace the following line with the actual URL you want to navigate to.
      var destinationUrl = '/video/courses/' + courseID + '/' + videoId ;

      // Redirect to the desired page
      window.location.href = destinationUrl;
   }