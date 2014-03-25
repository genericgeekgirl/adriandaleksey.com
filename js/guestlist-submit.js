
var aleksey = {
    googleDocSubmitLink : "https://spreadsheets.google.com/formResponse?formkey=dFE2Tm1YOTBkSlJSRnhxODIxVTVURlE6MQ&amp;theme=0AX42CRMsmRFbUy0xMTQxMTU1Yy04OGY5LTRkY2EtYTFjMC02YmNkMmI2OWNhZTQ&amp;ifq",

    onReadyDoc : function () {
      var googForm = $("form[name=google]");
      if (googForm.length !== 0) {
	aleksey.submitGoogleForm(googForm);
      }
    },

    submitGoogleForm : function (googForm) {
      googForm.prop('action', aleksey.googleDocSubmitLink);
      $("iframe").css('display', 'none').load(aleksey.googleDocFinishedLoading);
      aleksey.hideFormAndShowPleaseWait();
      googForm.submit();
    },

    googleDocFinishedLoading : function () {
      var f = $(".form-container");
      f.children(".please-wait").css('display', 'none');
      f.append("<p class=\"thank-you\">Thank you!  Hope to see you in May!</p>");
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




