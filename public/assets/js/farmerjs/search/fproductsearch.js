$(document).ready(function() {
    $('#search').on('input', function() {
        var query = $(this).val();

        // Include CSRF token in the headers
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            url: '/product/search',
            data: {
                query: query
            },
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                // Call the function to generate the HTML
                var tableHTML = generateTableHTML(response.posts);

                // Append the HTML to your table container (assuming you have a container with id "table-container")
                document.getElementById('search-results').innerHTML = '<table class="table table-striped"><thead><th>S/N</th><th>Name</th><th>Price</th><th>Quantity</th><th>PostedAt</th><th>Status</th><th>Sales</th><th colspan="2">action</th></thead><tbody>' + tableHTML + '</tbody></table>';

                // Show the search result div and hide the default div
                if (query.trim() === '' || response.posts.length === 0) {
                    // Show the default div and hide the search result div
                    $('#default-div').show();
                    $('#search-result').hide();
                } else {
                    // Show the search result div and hide the default div
                    $('#search-result').show();
                    $('#default-div').hide();
                }
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + status + " - " + error);
            }
        });
    });
});

// Function to handle the case when the search input is empty
function showDefaultContent() {
    // Show the default div and hide the search result div
    $('#default-div').show();
    $('#search-result').hide();
}

// Call the function when the page loads and when the search input is empty
$(document).ready(showDefaultContent);
$('#search').on('blur', showDefaultContent);

function generateTableHTML(posts) {
    var html = '';

    posts.forEach(function(post, index) {
        html += '<tr>';
        html += '<td>' + (index + 1) + '</td>'; // Serial number
        html += '<td>' + post.name + '</td>';
        html += '<td>' + post.price + '</td>';
        html += '<td>' + post.quantity + '</td>';
        // Convert created_at to human-readable format
        var createdAt = moment(post.created_at);
        var timeAgo = createdAt.fromNow();

        html += '<td>' + timeAgo + '</td>';

        if (post.is_verified == 0) {
            html += '<td>Not verified</td>';
        } else {
            html += '<td>Verified</td>';
        }

        if (post.is_sold > 0) {
            var sales = (post.quantity - post.is_sold) / 100;
            html += '<td>' + sales + '%</td>';
        } else {
            html += '<td>0%</td>';
        }

        html += '<td><a href="/farmproducts/edit/' + post.id + '" class="text-success">Edit</a></td>';
        html += '<td><a href="#" data-toggle="modal" data-target="#confirmDeleteModalvideo' + post.id + '" class="text-danger">Delete</a></td>';

        // Confirmation Modal
        html += '<div class="modal fade" id="confirmDeleteModalvideo' + post.id + '" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">';
        html += '<div class="modal-dialog" role="document">';
        html += '<div class="modal-content">';
        html += '<div class="modal-header">';
        html += '<h5 class="modal-title" id="confirmDeleteLabel">Confirm Delete</h5>';
        html += '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
        html += '<span aria-hidden="true">&times;</span>';
        html += '</button>';
        html += '</div>';
        html += '<div class="modal-body">';
        html += 'Are you sure you want to delete this record?';
        html += '</div>';
        html += '<div class="modal-footer">';
        html += '<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>';
        html += '<form method="POST" action="/farmproducts/delete/' + post.id + '">';
        // Check if window.Laravel is defined before accessing csrfToken
        if (window.Laravel && window.Laravel.csrfToken) {
            html += '<input type="hidden" name="_token" value="' + window.Laravel.csrfToken + '">';
        }
        html += '<input type="hidden" name="_method" value="DELETE">';
        html += '<button type="submit" class="btn btn-danger">Delete</button>';
        html += '</form>';
        html += '</div>';
        html += '</div>';
        html += '</div>';
        html += '</div>';

        html += '</tr>';
    });

    return html;
}
