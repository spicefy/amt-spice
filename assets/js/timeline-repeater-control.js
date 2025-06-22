jQuery(document).ready(function($) {
    // Initialize controls
    $('.timeline-repeater').each(function() {
        var $container = $(this);
        var $itemsContainer = $container.find('.timeline-repeater-items');
        var $dataInput = $container.find('.timeline-repeater-data');
        var fields = $container.data('fields') || {};
        
        // Add new item
        $container.on('click', '.timeline-repeater-add', function(e) {
            e.preventDefault();
            
            var index = $itemsContainer.children().length;
            var itemHtml = wp.template('timeline-repeater-item')({
                index: index,
                item: {},
                fields: fields
            });
            
            $itemsContainer.append(itemHtml);
            updateData();
        });
        
        // Remove item
        $container.on('click', '.timeline-repeater-item-remove', function(e) {
            e.preventDefault();
            $(this).closest('.timeline-repeater-item').remove();
            updateData();
        });
        
        // Sort items
        $itemsContainer.sortable({
            handle: '.timeline-repeater-item-header',
            update: function() {
                updateData();
            }
        });
        
        // Update field values
        $container.on('change keyup', '.timeline-repeater-field-control', function() {
            updateData();
        });
        
        // Update the hidden input with JSON data
        function updateData() {
            var data = [];
            
            $itemsContainer.children().each(function() {
                var $item = $(this);
                var itemData = {};
                
                $item.find('.timeline-repeater-field-control').each(function() {
                    var $field = $(this);
                    var fieldName = $field.data('field');
                    itemData[fieldName] = $field.val();
                });
                
                data.push(itemData);
            });
            
            $dataInput.val(JSON.stringify(data)).trigger('change');
        }
    });
    
    // Create template for new items
    wp.template.addTemplate('timeline-repeater-item', function(data) {
        var html = '<div class="timeline-repeater-item" data-index="' + data.index + '">' +
            '<div class="timeline-repeater-item-header">' +
                '<span class="timeline-repeater-item-title">' + wp.i18n.sprintf(wp.i18n.__('Item #%d', 'your-theme'), data.index + 1) + '</span>' +
                '<button type="button" class="button timeline-repeater-item-remove">' + wp.i18n.__('Remove', 'your-theme') + '</button>' +
            '</div>' +
            '<div class="timeline-repeater-item-fields">';
        
        for (var fieldName in data.fields) {
            if (data.fields.hasOwnProperty(fieldName)) {
                var field = data.fields[fieldName];
                var value = data.item[fieldName] || '';
                
                html += '<div class="timeline-repeater-field">' +
                    '<label>' +
                        '<span class="timeline-repeater-field-label">' + field.label + '</span>';
                
                if (field.type === 'text') {
                    html += '<input type="text" class="timeline-repeater-field-control" data-field="' + fieldName + '" value="' + value + '">';
                } else if (field.type === 'textarea') {
                    html += '<textarea class="timeline-repeater-field-control" data-field="' + fieldName + '">' + value + '</textarea>';
                }
                
                html += '</label></div>';
            }
        }
        
        html += '</div></div>';
        return html;
    });
});