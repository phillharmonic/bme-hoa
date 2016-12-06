$(document).ready(function(){ 

    var $collectionHolder;

    // setup an "add a tag" link
    var $addPicLink = $('<a href="#" class="add_tag_link">Add Picture</a>');
    var $newLinkDiv = $('<div></div>').append($addPicLink);

    jQuery(document).ready(function() {
        // Get the div that holds the collection of tags
        $collectionHolder = $('div.images');

        // add the "add a Pic" anchor and li to the tags ul
        $collectionHolder.append($newLinkDiv);
        
        // add a delete link to each section of existing picture objects
        $collectionHolder.find('section').each(function() {
            addDeleteLink($(this));
        });

        // count the current form inputs we have (e.g. 2), use that as the new
        // index when inserting a new item (e.g. 2)
        $collectionHolder.data('index', $collectionHolder.find(':input').length);

        $addPicLink.on('click', function(e) {
            // prevent the link from creating a "#" on the URL
            e.preventDefault();

            // add a new tag form (see next code block)
            addPictureForm($collectionHolder, $newLinkDiv);
        });
    });
    
    function addPictureForm($collectionHolder, $newLinkDiv) {
        // Get the data-prototype explained earlier
        var prototype = $collectionHolder.data('prototype');

        // get the new index
        var index = $collectionHolder.data('index');

        // Replace '__name__' in the prototype's HTML to
        // instead be a number based on how many items we have
        var newForm = prototype.replace(/__name__/g, index);

        // increase the index with one for the next item
        $collectionHolder.data('index', index + 1);

        // Display the form in the page in a div, before the "Add Picture" link div
        var $newFormDiv = $('<div></div>').append(newForm);
        $newLinkDiv.before($newFormDiv);
        
    }
    
    function addDeleteLink($pictureFormDiv) {
        var $removeFormA = $('<a href="#" class="delete_picture_link" >Delete Photo</a>');
        $pictureFormDiv.append($removeFormA);

        $removeFormA.on('click', function(e) {
            // prevent the link from creating a "#" on the URL
            e.preventDefault();

            // remove the div for the picture form
            $pictureFormDiv.remove();
        });
    }

});

