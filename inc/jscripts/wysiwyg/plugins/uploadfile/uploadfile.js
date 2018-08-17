(function (factory) {
  /* global define */
  if (typeof define === 'function' && define.amd) {
    // AMD. Register as an anonymous module.
    define(['jquery'], factory);
  } else if (typeof module === 'object' && module.exports) {
    // Node/CommonJS
    module.exports = factory(require('jquery'));
  } else {
    // Browser globals
    factory(window.jQuery);
  }
}(function ($) {

  // minimal dialog plugin
  $.extend($.summernote.plugins, {
    /**
     * @param {Object} context - context object has status of editor.
     */
    'fileupload': function (context) {
      var self = this;

      // ui has renders to build ui elements.
      //  - you can create a button with `ui.button`
      var ui = $.summernote.ui;

			var $editor = context.layoutInfo.editor;
			var options = context.options;
			
      // add context menu button
      context.memo('button.fileupload', function () {
        return ui.button({
          contents: '<i class="fa fa-upload"/>',
          tooltip: 'Plik',
          click: context.createInvokeHandler('fileupload.showDialog')
        }).render();
      });

      // This method will be called when editor is initialized by $('..').summernote();
      // You can create elements for plugin
      self.initialize = function () {
				var $container = options.dialogsInBody ? $(document.body) : $editor;
				
				var body = '<form><b>Wybierz z dysku</b><br><input type="file" id="myFile" multiple size="50" class="filechoser form-control"><br><br><b>Tytuł</b><br><input class="filetitle form-control" id="filetitle" size=100%> </input></form>';
				var footer = '<input type="button" class="btn btn-primary dialogok" value="Wstaw plik"></input>';

				self.$dialog = ui.dialog({
					title: 'Wgraj plik',
					fade: options.dialogsFade,
					body: body,
					footer: footer
				}).render().appendTo($container);
				
      };


      // This methods will be called when editor is destroyed by $('..').summernote('destroy');
      // You should remove elements on `initialize`.
      self.destroy = function () {
        self.$dialog.remove();
        self.$dialog = null;
      };

			self.showDialog = function () {
				self
					.openDialog()
					.then(function (dialogData) {
						// [workaround] hide dialog before restore range for IE range focus
						ui.hideDialog(self.$dialog);
						context.invoke('editor.restoreRange');
						
						// do something with dialogData
						console.log("dialog returned: ", dialogData)
						// ...
					})
					.fail(function () {
						context.invoke('editor.restoreRange');
					});

			};
			
	    self.openDialog = function () {
				return $.Deferred(function (deferred) {
					var $dialogBtn = self.$dialog.find('.dialogok');
					var $fileBtn = self.$dialog.find('.filechoser');

					ui.onDialogShown(self.$dialog, function () {
						context.invoke('editor.saveRange');
						context.triggerEvent('dialog.shown');
						document.getElementById("myFile").value = "";
						document.getElementById("filetitle").value = "";
						$dialogBtn
						  .click(function (event) {
							var x = document.getElementById("myFile").files[0];
							var y = document.getElementById("filetitle").value;
							context.invoke('editor.restoreRange');
							context.invoke('editor.pasteHTML', '<a href="http://77.55.211.142/uploads/file/'+x.name+'">'+y+'</a>');
							ui.hideDialog(self.$dialog);
							context.invoke('editor.focus');
 						});

				                 $fileBtn
                                                  .change(function (event) {
							var x = document.getElementById("myFile").files[0];
							var y = document.getElementById("filetitle").value = x.name;
  							var fd = new FormData();
  							fd.append("afile", x);
  							var xhr = new XMLHttpRequest();
  							xhr.open('POST', 'http://77.55.211.142/file_upload.php', true);
	  						xhr.send(fd);
                                                });
					});

					ui.onDialogHidden(self.$dialog, function () {
						$dialogBtn.off('click');

						if (deferred.state() === 'pending') {
							deferred.reject();
						}
					});

					ui.showDialog(self.$dialog);
				});
			};

    }
  });

}));
