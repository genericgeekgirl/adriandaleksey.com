
var aleksey = {
    googleDocSubmitLink : "https://spreadsheets.google.com/formResponse?formkey=dC1xVzd6UGRHUlhaYkhLYW1BS2NxSlE6MQ&amp;ifq",
    onReadyDoc : function () {
	// skeleton
      var googForm = $("form[name=google]");
      if (googForm.length != 0) {
	aleksey.submitGoogleForm(googForm);
      }
    },

    submitGoogleForm : function (googForm) {
      googForm.prop('action', aleksey.googleDocSubmitLink);
      $("iframe").css('display', 'none')
	.load((function (willAttend) {
		 return function () {
		   aleksey.googleDocFinishedLoading(willAttend);
		 };
	       })($(googForm).find("input[name=\"entry.9.group\"]").val())
	     );
      aleksey.hideFormAndShowPleaseWait();
      googForm.submit();
    },

    googleDocFinishedLoading : function (willAttend) {
      var f = $(".form-container");
      f.children(".please-wait").css('display', 'none');
      var msgYes = "Thank you! Looking forward to seeing you in May!";
      var msgNo = "Thank you! Please let us know if you change your mind!";
      var msg;
      if (willAttend=="yes") msg = msgYes;
      else msg = msgNo;
      f.append("<p class=\"thank-you\">" + msg + "</p>");
    },

    hideFormAndShowPleaseWait : function () {
      var t = $(".form-title");
      t.css('display', 'none');
      var f = $(".form-container");
      f.children("form").css('display','none');
      f.append("<p class=\"please-wait\">Please Wait...</p>");
    }
  
};


$(document).ready(aleksey.onReadyDoc);

