<script>
var SweetAlert2Demo = (function() {
    var initDemos = function() {
        document.querySelectorAll(".delete_alert_player").forEach(function(button) {
            button.addEventListener("click", function(e) {
                e.preventDefault();
                const playerId = button.getAttribute("data-player-id");
                const form = document.getElementById(`delete-player-${playerId}`);

                swal({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    buttons: {
                        cancel: {
                            visible: true,
                            text: "No, cancel!",
                            className: "btn btn-success",
                        },
                        confirm: {
                            text: "Yes, delete it!",
                            className: "btn btn-danger",
                        },
                    },
                }).then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    } else {
                        swal("Your player is safe!", {
                            buttons: {
                                confirm: {
                                    className: "btn btn-success",
                                },
                            },
                        });
                    }
                });
            });
        });
    };

    return {
        init: function() {
            initDemos();
        },
    };
})();

SweetAlert2Demo.init();
</script>
