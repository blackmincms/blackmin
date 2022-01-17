/*!
 *
 * The MIT License
 *
 * author:  di_Timonix
 * version: 0.1.0
 *
 */

function Checkall(element, options) {
  'use strict';

  this.self  = $(element);
  this.opt   = $.extend(true, {}, $.fn.checkall.defaults, options);
  this.all   = this.self.find(this.opt.all);
  this.items = this.self.find(this.opt.item);
  this.total = this.items.length;
}

Checkall.prototype._bindAll = function(oEvent) {
  'use strict';

  var that = this;

  this.all.on('change', function(oEvent) {
    that.items.prop('checked', this.checked);
  });
};

Checkall.prototype._bindItems = function(oEvent) {
  'use strict';

  this.items.on('change', this._inspect.bind(this));
};

Checkall.prototype._create = function(oEvent) {
  'use strict';

  this._bindAll();
  this._bindItems();
  this._inspect();
};

Checkall.prototype._inspect = function(oEvent) {
  'use strict';

  var checked = this.items.filter(':checked');

  this.all.prop('checked', checked.length === this.total);
};

(function($) {
  'use strict';

  $.fn.checkall = function(options) {
    var
      args   = Array.prototype.slice.call(arguments, 1),
      method = Checkall.prototype[options];

    return this.each(function() {
      var
        self     = $(this),
        instance = self.data('checkall');

      if (!instance) {
        instance = new Checkall(this, options);

        instance._create();

        self.data('checkall', instance);
      }

      if (method) {
        method.apply(instance, args);
      } else if (options && typeof options !== 'object') {
        $.error('Method "' + options + '" not found.');
      }
    });
  };

  $.fn.checkall.defaults = {
    all:  '.checkall__all',
    item: '.checkall__item'
  };
})(jQuery);
