/*
 * Mentions Input
 * Version 1.0.2
 * Written by: Kenneth Auchenberg (Podio)
 *
 * Using underscore.js
 *
 * License: MIT License - http://www.opensource.org/licenses/mit-license.php
 */

function initMention(el, char, min) {
    // Settings
    var KEY = { BACKSPACE: 8, TAB: 9, RETURN: 13, ESC: 27, LEFT: 37, UP: 38, RIGHT: 39, DOWN: 40, COMMA: 188, SPACE: 32, HOME: 36, END: 35 }; // Keys "enum"
    //Default settings
    var defaultSettings = {
        triggerChar: char, //Char that respond to event
        onDataRequest: jQuery.noop, //Function where we can search the data
        minChars: min, //Minimum chars to fire the event
        showAvatars: true, //Show the avatars
        classes: {
            autoCompleteItemActive: "active" //Classes to apply in each item
        },
        templates: {
            wrapper: _.template('<div class="mentions-input-box_'+el+'"></div>'),
            autocompleteList: _.template('<div class="mentions-autocomplete-list"></div>'),
            autocompleteListItem: _.template('<li data-ref-id="<%= id %>" data-ref-type="<%= type %>" data-display="<%= display %>"><%= content %></li>'),
            autocompleteListItemAvatar: _.template('<img  src="<%= avatar %>" />'),
            autocompleteListItemIcon: _.template('<div class="icon <%= icon %>"></div>'),
            mentionItemSyntax: _.template('@[<%= value %>](<%= type %>:<%= id %>)'),
            mentionItemHighlight: _.template('<strong><span><%= value %></span></strong>')
        }
    };
    //Class util
    var utils = {
        //Encodes the character with _.escape function (undersocre)
        htmlEncode: function(str) {
            return _.escape(str);
        },
        highlightTerm: function(value, term) {
            if (!term && !term.length) {
                return value;
            }
            return value.replace(new RegExp("(?![^&;]+;)(?!<[^<>]*)(" + term + ")(?![^<>]*>)(?![^&;]+;)", "gi"), "<b>$1</b>");
        },
        //Sets the caret in a valid position
        setCaratPosition: function(domNode, caretPos) {
            if (domNode.createTextRange) {
                var range = domNode.createTextRange();
                range.move('character', caretPos);
                range.select();
            } else {
                if (domNode.selectionStart) {
                    domNode.focus();
                    domNode.setSelectionRange(caretPos, caretPos);
                } else {
                    domNode.focus();
                }
            }
        },
        //Deletes the white spaces
        rtrim: function(string) {
            return string.replace(/\s+$/, "");
        }
    };

    //Main class of MentionsInput plugin
    var MentionsInput = function(input) {
        var settings;
        var elmInputBox, elmInputWrapper, elmAutocompleteList, elmWrapperBox, elmActiveAutoCompleteItem;
        var mentionsCollection = [];
        var inputBuffer = [];
        var currentDataQuery;

        //Initializes the text area target
        function initTextarea() {
            elmInputBox = jQuery(input); //Get the text area target

            //If the text area is already configured, return
            if (elmInputBox.attr('data-mentions-input') == 'true') {
                return;
            }

            elmInputWrapper = elmInputBox.parent(); //Get the DOM element parent
            elmWrapperBox = jQuery(settings.templates.wrapper());
            elmInputBox.wrapAll(elmWrapperBox); //Wrap all the text area into the div elmWrapperBox
            elmWrapperBox = elmInputWrapper.find('> div'); //Obtains the div elmWrapperBox that now contains the text area

            elmInputBox.attr('data-mentions-input', 'true'); //Sets the attribute data-mentions-input to true -> Defines if the text area is already configured
        }

        //Initializes the autocomplete list, append to elmWrapperBox and delegate the mousedown event to li elements
        function initAutocomplete() {
            elmAutocompleteList = jQuery(settings.templates.autocompleteList()); //Get the HTML code for the list
            elmAutocompleteList.appendTo(elmWrapperBox); //Append to elmWrapperBox element
            elmAutocompleteList.delegate('li', 'click', onAutoCompleteItemClick); //Delegate the event
        }

        //Cleans the buffer
        function resetBuffer() {
            inputBuffer = [];
        }

        //Updates the mentions collection
        function updateMentionsCollection() {
            var inputText = getInputBoxValue(); //Get the actual value of text area

            //Returns the values that doesn't match the condition
            mentionsCollection = _.reject(mentionsCollection, function(mention, index) {
                return !mention.value || inputText.indexOf(mention.value) == -1;
            });
            mentionsCollection = _.compact(mentionsCollection); //Delete all the falsy values of the array and return the new array
        }

        //Adds mention to mentions collections
        function addMention(value, id, type) {
            var currentMessage = getInputBoxValue();
            var findString = settings.triggerChar + currentDataQuery;

            // Using a regex to figure out positions
            var regex = new RegExp("\\" + findString, "gi");
            regex.exec(currentMessage);

            var startCaretPosition = regex.lastIndex - currentDataQuery.length - 1; //Set the start caret position (right before the @)
            var currentCaretPosition = regex.lastIndex; //Set the current caret position (right after the end of the "mention")

            var start = currentMessage.substr(0, startCaretPosition);
            var end = currentMessage.substr(currentCaretPosition, currentMessage.length);
            var startEndIndex = (start + value).length;

            var updatedMessageText = start + value + end;

            mentionsCollection.push({
                id: id,
                type: type,
                value: value
            });

            // Cleaning before inserting the value, otherwise auto-complete would be triggered with "old" inputbuffer
            resetBuffer();
            currentDataQuery = '';
            hideAutoComplete();

            var editor = CKEDITOR.instances[el];
            var sel = editor.getSelection();


            var element = sel.getStartElement();
            sel.selectElement(element);

            var ranges = editor.getSelection().getRanges();

            var nodeList = element.getChildren();
            for (i = 0; i < nodeList.count(); i++) {
                var elementChild = nodeList.getItem(i);
                var startIndex = elementChild.getText().toLowerCase().indexOf(findString.toLowerCase());

                if (startIndex != -1) {
                    ranges[0].setStart(elementChild, startIndex);
                    ranges[0].setEnd(elementChild, startIndex + findString.length);
                    sel.selectRanges([ranges[0]]);

                    var range = sel.getRanges()[0];
                    range.deleteContents();
                    range.select();

                    editor.insertHtml('<a href="#/users/profile/'+id+'" target="_blank">'+value+'</a>');
                }
            }
            editor.updateElement();

        }

        //Gets the actual value of the text area without white spaces from the beginning and end of the value
        function getInputBoxValue() {
            return jQuery.trim(CKEDITOR.instances[el].getData());
        }

        //Takes the click event when the user select a item of the dropdown
        function onAutoCompleteItemClick(e) {
            var elmTarget = jQuery(this); //Get the item selected

            addMention(elmTarget.attr('data-display'), elmTarget.attr('data-ref-id'), elmTarget.attr('data-ref-type'));

            return false;
        }

        //Takes the click event on text area
        window.onInputBoxClick = function(e) {
            resetBuffer();
        }

        //Takes the input event when users write or delete something
        window.onInputBoxInput = function(e) {
            updateMentionsCollection();
            hideAutoComplete();
            var triggerCharIndex = _.lastIndexOf(inputBuffer, settings.triggerChar);
            if (triggerCharIndex > -1) {
                currentDataQuery = inputBuffer.slice(triggerCharIndex + 1).join('');
                currentDataQuery = utils.rtrim(currentDataQuery);
                _.defer(_.bind(doSearch, this, currentDataQuery));
            }
        }

        //Takes the keypress event
        window.onInputBoxKeyPress = function(e) {
            var keyCode = (e.data.keyCode === undefined ? e.data.getKey() : e.data.keyCode);
            var typedValue = String.fromCharCode(keyCode); //Takes the string that represent this CharCode
            inputBuffer.push(typedValue); //Push the value pressed into inputBuffer
        }

        //Takes the keydown event
        window.onInputBoxKeyDown = function(e) {
            var keyCode = (e.data.keyCode === undefined ? e.data.getKey() : e.data.keyCode);

            // This also matches HOME/END on OSX which is CMD+LEFT, CMD+RIGHT
            if (keyCode == KEY.LEFT || keyCode == KEY.RIGHT || keyCode == KEY.HOME || keyCode == KEY.END) {
                // Defer execution to ensure carat pos has changed after HOME/END keys
                _.defer(resetBuffer);
                return;
            }

            //If the key pressed was the backspace
            if (keyCode == KEY.BACKSPACE) {
                inputBuffer = inputBuffer.slice(0, -1 + inputBuffer.length); // Can't use splice, not available in IE
                return;
            }

            //If the elmAutocompleteList is hidden
            if (!elmAutocompleteList.is(':visible')) {
                return true;
            }

            switch (keyCode) {
                case KEY.UP: //If the key pressed was UP or DOWN
                case KEY.DOWN:
                    var elmCurrentAutoCompleteItem = null;
                    if (keyCode == KEY.DOWN) { //If the key pressed was DOWN
                        if (elmActiveAutoCompleteItem && elmActiveAutoCompleteItem.length) { //If elmActiveAutoCompleteItem exits
                            elmCurrentAutoCompleteItem = elmActiveAutoCompleteItem.next(); //Gets the next li element in the list
                        } else {
                            elmCurrentAutoCompleteItem = elmAutocompleteList.find('li').first(); //Gets the first li element found
                        }
                    } else {
                        elmCurrentAutoCompleteItem = jQuery(elmActiveAutoCompleteItem).prev(); //The key pressed was UP and gets the previous li element
                    }

                    if (elmCurrentAutoCompleteItem.length) {
                        selectAutoCompleteItem(elmCurrentAutoCompleteItem);
                    }
                    e.data.preventDefault();

                    return false;

                case KEY.RETURN: //If the key pressed was RETURN or TAB
                case KEY.TAB:
                    if (elmActiveAutoCompleteItem && elmActiveAutoCompleteItem.length) { //If the elmActiveAutoCompleteItem exists
                        elmActiveAutoCompleteItem.click(); //Calls the mousedown event
                        e.data.preventDefault();
                        return false;
                    }

                    break;
            }

            return true;
        }

        //Hides the autoomplete
        function hideAutoComplete() {
            elmActiveAutoCompleteItem = null;
            elmAutocompleteList.empty().hide();
        }

        //Selects the item in the autocomplete list
        function selectAutoCompleteItem(elmItem) {
            elmItem.addClass(settings.classes.autoCompleteItemActive); //Add the class active to item
            elmItem.siblings().removeClass(settings.classes.autoCompleteItemActive); //Gets all li elements in autocomplete list and remove the class active

            elmActiveAutoCompleteItem = elmItem; //Sets the item to elmActiveAutoCompleteItem
        }

        //Populates dropdown
        function populateDropdown(query, results) {
            //Shows the autocomplete list
            elmAutocompleteList.show();

            // Filter items that has already been mentioned
            var mentionValues = _.pluck(mentionsCollection, 'value');
            results = _.reject(results, function(item) {
                return _.include(mentionValues, item.name);
            });

            if (!results.length) { //If there are not elements hide the autocomplete list
                hideAutoComplete();
                return;
            }

            elmAutocompleteList.empty(); //Remove all li elements in autocomplete list
            var elmDropDownList = jQuery("<ul>").appendTo(elmAutocompleteList).hide(); //Inserts a ul element to autocomplete div and hide it

            _.each(results, function(item, index) {
                var elmListItem = jQuery(settings.templates.autocompleteListItem({
                    'id': utils.htmlEncode(item.id),
                    'display': utils.htmlEncode(item.name),
                    'type': utils.htmlEncode(item.type),
                    'content': utils.highlightTerm(utils.htmlEncode((item.name)), query)
                })); //Inserts the new item to list

                //If the index is 0
                if (index === 0) {
                    selectAutoCompleteItem(elmListItem);
                }

                //If show avatars is true
                if (settings.showAvatars) {
                    var elmIcon;

                    //If the item has an avatar
                    if (item.avatar) {
                        elmIcon = jQuery(settings.templates.autocompleteListItemAvatar({ avatar: item.avatar }));
                    } else { //If not then we set an default icon
                        elmIcon = jQuery(settings.templates.autocompleteListItemIcon({ icon: item.icon }));
                    }
                    elmIcon.prependTo(elmListItem); //Inserts the elmIcon to elmListItem
                }
                elmListItem = elmListItem.appendTo(elmDropDownList); //Insets the elmListItem to elmDropDownList
            });

            elmAutocompleteList.show(); //Shows the elmAutocompleteList div
            elmDropDownList.show(); //Shows the elmDropDownList
        }

        //Search into data list passed as parameter
        function doSearch(query) {
            //If the query is not null, undefined, empty and has the minimum chars
            if (query && query.length && query.length >= settings.minChars) {
                //Call the onDataRequest function and then call the populateDropDrown
                settings.onDataRequest.call(this, 'search', query, function(responseData) {
                    populateDropdown(query, responseData);
                });
            }
        }

        // Public methods
        return {
            //Initializes the mentionsInput component on a specific element.
            init: function(options) {
                settings = options;

                initTextarea();
                initAutocomplete();
            },

            //An async method which accepts a callback function and returns a value of the input field (including markup) as a first parameter of this function. This is the value you want to send to your server.
            val: function(callback) {
                if (!_.isFunction(callback)) {
                    return;
                }

                var value = mentionsCollection.length ? elmInputBox.data('messageText') : getInputBoxValue();
                callback.call(this, value);
            },

            //Resets the text area value and clears all mentions
            reset: function() {
                elmInputBox.val('');
                mentionsCollection = [];
            },

            //An async method which accepts a callback function and returns a collection of mentions as hash objects as a first parameter.
            getMentions: function(callback) {
                if (!_.isFunction(callback)) {
                    return;
                }

                callback.call(this, mentionsCollection);
            }
        };
    };

    //Main function to include into jQuery and initialize the plugin
    jQuery.fn.mentionsInputUser = function(method, settings) {
        console.log(settings);
        if (typeof method === 'object' || !method) {
            settings = jQuery.extend(true, {}, defaultSettings, method);
        }

        var outerArguments = arguments; //Gets the arguments

        return this.each(function() {
            var instance = jQuery.data(this, 'mentionsInput') || jQuery.data(this, 'mentionsInput', new MentionsInput(this));

            if (_.isFunction(instance[method])) {
                return instance[method].apply(this, Array.prototype.slice.call(outerArguments, 1));

            } else if (typeof method === 'object' || !method) { //If method is not a function
                return instance.init.call(this, settings);

            } else {
                jQuery.error('Method ' + method + ' does not exist');
            }

        });
    };
    //Main function to include into jQuery and initialize the plugin
    jQuery.fn.mentionsInputTask = function(method, settings) {
        console.log(settings);
        if (typeof method === 'object' || !method) {
            settings = jQuery.extend(true, {}, defaultSettings, method);
        }

        var outerArguments = arguments; //Gets the arguments

        return this.each(function() {
            var instance = jQuery.data(this, 'mentionsInput') || jQuery.data(this, 'mentionsInput', new MentionsInput(this));

            if (_.isFunction(instance[method])) {
                return instance[method].apply(this, Array.prototype.slice.call(outerArguments, 1));

            } else if (typeof method === 'object' || !method) { //If method is not a function
                return instance.init.call(this, settings);

            } else {
                jQuery.error('Method ' + method + ' does not exist');
            }

        });
    };
};

function initUsers(el) {
    jQuery.ajax({
        url: basePath + "/_teacher/crm/_tasks/tasks/getTasksList",
        dataType: "json",                     // тип загружаемых данных
        success: function (response) { // вешаем свой обработчик на функцию success
            jQuery('textarea.mention').mentionsInputUser({
                onDataRequest: function (mode, query, callback) {
                    var data = _.filter(response, function (item) {
                        return item.name.toLowerCase().indexOf(query.toLowerCase()) > -1
                    });
                    callback.call(this, data);
                }
            });
        }
    });
}
function initTasks(el) {
    jQuery.ajax({
        url: basePath + "/_teacher/crm/_tasks/tasks/getTasksList",
        dataType: "json",                     // тип загружаемых данных
        success: function (response) { // вешаем свой обработчик на функцию success
            jQuery('textarea.mention').mentionsInputTask({
                onDataRequest: function (mode, query, callback) {
                    var data = _.filter(response, function (item) {
                        return item.name.toLowerCase().indexOf(query.toLowerCase()) > -1
                    });
                    callback.call(this, data);
                }
            });
        }
    });
}
