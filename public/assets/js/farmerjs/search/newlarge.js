// $(document).ready(function() {
//     $('#search').on('input', function() {
//         var query = $(this).val();

//         // Include CSRF token in the headers
//         var csrfToken = $('meta[name="csrf-token"]').attr('content');

//         $.ajax({
//             type: 'POST',
//             url: '/news/search',
//             data: {
//                 searchinput: query
//             },
            
//             headers: {
//                 'X-CSRF-TOKEN': csrfToken
//             },
//             success: function(response) {
//                 // Call the function to generate the HTML
//                 var tableHTML = generatesearchcontentHTML(response.posts);

//                 // Append the HTML to your table container (assuming you have a container with id "table-container")
//                 document.getElementById('search-results').innerHTML = tableHTML ;

//                 // Show the search result div and hide the default div
//                 if (query.trim() === '' || response.posts.length === 0) {
//                     // Show the default div and hide the search result div
//                     $('#default-div').show();
//                     $('#search-result').hide();
//                 } else {
//                     // Show the search result div and hide the default div
//                     $('#search-result').show();
//                     $('#default-div').hide();
//                 }
//             },
//             error: function(xhr, status, error) {
//                 console.error("AJAX Error: " + status + " - " + error);
//             }
//         });
//     });
// });

// // Function to handle the case when the search input is empty
// function showDefaultContent() {
//     // Show the default div and hide the search result div
//     $('#default-div').show();
//     $('#search-result').hide();
// }

// // Call the function when the page loads and when the search input is empty
// $(document).ready(showDefaultContent);
// $('#search').on('blur', showDefaultContent);

// function generatesearchcontentHTML(posts) {
//     var html = '';
//     html += '<ul>';
//     posts.forEach(function(post, index) {
        
//         html += '<li><a href="/farmproducts/edit/' + post.id + '"> '+ post.content + '</a></li>';
//         html += '<hr>';
       
//     });
//     html += '</ul>';

//     return html;
// }
