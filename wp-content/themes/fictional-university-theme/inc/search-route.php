<?php

function university_register_search()
{
    register_rest_route(
        "university/v1", // name space
        "search", // route
        [
            "method" => WP_REST_Server::READABLE, // make universal
            "callback" => "university_search_results",
            'permission_callback' => '__return_true'
        ]
    );
}

function university_search_results(WP_REST_Request $request)
{
    $main_query = new WP_Query([
        "post_type" => ["post", "page", "professor", "program", "event", "campus"],
        "s" => sanitize_text_field($request["term"]), // s=>search
    ]);

    $results = [
        "general_info" => [],
        "professors" => [],
        "programs" => [],
        "events" => [],
        "campuses" => []
    ];

    while ($main_query->have_posts()) {
        $main_query->the_post();

        if (get_post_type() == "post" || get_post_type() == "page") {
            array_push($results["general_info"], [
                "title" => get_the_title(),
                "permalink" => get_the_permalink(),
                "post_type" => get_post_type(),
                "author_name" => get_the_author(),
            ]);
        } else if (get_post_type() == "professor") {
            array_push($results["professors"], [
                "title" => get_the_title(),
                "permalink" => get_the_permalink()
            ]);
        } else if (get_post_type() == "program") {
            array_push($results["programs"], [
                "title" => get_the_title(),
                "permalink" => get_the_permalink()
            ]);
        } else if (get_post_type() == "event") {
            array_push($results["events"], [
                "title" => get_the_title(),
                "permalink" => get_the_permalink()
            ]);
        } else if (get_post_type() == "campus") {
            array_push($results["campuses"], [
                "title" => get_the_title(),
                "permalink" => get_the_permalink()
            ]);
        }
    }

    return $results;
}

add_action("rest_api_init", "university_register_search");
