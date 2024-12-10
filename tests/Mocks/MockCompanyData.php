<?php

namespace Tests\Mocks;

class MockCompanyData
{
    public function get_mock_data_for_all_companies()
    {
        return collect([
            (object)[
                'id' => 1,
                'name' => 'Tech Corp',
                'url' => 'https://techcorp.com/',
                'about' => 'Tech Corp is a technology company specializing in PHP and Laravel.',
                'source_slug' => 'tech-corp',
                'ceo' => (object)['name' => 'Jane Doe'],
                'ceo_contact' => null,
                'cto_contact' => null,
                'cto_name' => 'John Doe',
                'hr_contact' => null,
                'logo' => 'https://techcorp.com/logo.png',
                'is_mobile_only' => true,
                'hr' => null,
                'plangs' => collect([
                    (object)['name' => 'PHP', 'pivot' => (object)['rating' => 4.5]],
                    (object)['name' => 'JavaScript', 'pivot' => (object)['rating' => 4.0]],
                ]),
                'frameworks' => collect([
                    (object)['name' => 'Laravel', 'pivot' => (object)['rating' => 4.5]],
                    (object)['name' => 'Vue.js', 'pivot' => (object)['rating' => 4.0]],
                ]),
                'feFrameworks' => collect([
                    (object)['name' => 'React', 'pivot' => (object)['rating' => 4.5]],
                    (object)['name' => 'Angular', 'pivot' => (object)['rating' => 4.0]],
                ]),
                'mobilePlangs' => collect([
                    (object)['name' => 'Swift', 'pivot' => (object)['rating' => 4.5]],
                    (object)['name' => 'Kotlin', 'pivot' => (object)['rating' => 4.0]],
                ]),
            ],
            (object)[
                'id' => 2,
                'name' => 'HighTech Solutions',
                'url' => 'https://hightechsolutions.com/',
                'about' => 'HighTech Solutions focuses on innovative solutions with Node.js and Angular.',
                'source_slug' => 'high-tech-solutions',
                'ceo' => (object)['name' => 'John Doe'],
                'ceo_contact' => null,
                'cto_contact' => null,
                'cto_name' => 'Jane Doe',
                'hr_contact' => null,
                'logo' => 'https://hightechsolutions.com/logo.png',
                'is_mobile_only' => false,
                'hr' => null,
                'plangs' => collect([
                    (object)['name' => 'JavaScript', 'pivot' => (object)['rating' => 4.5]],
                    (object)['name' => 'Python', 'pivot' => (object)['rating' => 4.0]],
                ]),
                'frameworks' => collect([
                    (object)['name' => 'Node.js', 'pivot' => (object)['rating' => 4.5]],
                    (object)['name' => 'Angular', 'pivot' => (object)['rating' => 4.0]],
                ]),
                'feFrameworks' => collect([
                    (object)['name' => 'React', 'pivot' => (object)['rating' => 4.5]],
                    (object)['name' => 'Vue.js', 'pivot' => (object)['rating' => 4.0]],
                ]),
                'mobilePlangs' => collect([
                    (object)['name' => 'Swift', 'pivot' => (object)['rating' => 4.5]],
                    (object)['name' => 'Kotlin', 'pivot' => (object)['rating' => 4.0]],
                ]),
            ],
            (object)[
                'id' => 3,
                'name' => 'Tech Solutions',
                'url' => 'https://techsolutions.com/',
                'about' => 'Tech Solutions is a technology company specializing in Python and Django.',
                'source_slug' => 'tech-solutions',
                'ceo' => (object)['name' => 'Jane Doe'],
                'ceo_contact' => null,
                'cto_contact' => null,
                'cto_name' => 'John Doe',
                'hr_contact' => null,
                'logo' => 'https://techsolutions.com/logo.png',
                'is_mobile_only' => false,
                'hr' => null,
                'plangs' => collect([
                    (object)['name' => 'Python', 'pivot' => (object)['rating' => 4.5]],
                    (object)['name' => 'JavaScript', 'pivot' => (object)['rating' => 4.0]],
                ]),
                'frameworks' => collect([
                    (object)['name' => 'Django', 'pivot' => (object)['rating' => 4.5]],
                    (object)['name' => 'React', 'pivot' => (object)['rating' => 4.0]],
                ]),
                'feFrameworks' => collect([
                    (object)['name' => 'Vue.js', 'pivot' => (object)['rating' => 4.5]],
                    (object)['name' => 'Angular', 'pivot' => (object)['rating' => 4.0]],
                ]),
                'mobilePlangs' => collect([
                    (object)['name' => 'Swift', 'pivot' => (object)['rating' => 4.5]],
                    (object)['name' => 'Kotlin', 'pivot' => (object)['rating' => 4.0]],
                ]),
            ]
        ]);
    }

    public function get_mock_data_for_search_term_companies()
    {
        return collect([
            (object)[
                'id' => 1,
                'name' => 'Tech Corp',
                'url' => 'https://techcorp.com/',
                'about' => 'Tech Corp is a technology company specializing in PHP and Laravel.',
                'source_slug' => 'tech-corp',
                'ceo' => (object)['name' => 'Jane Doe'],
                'ceo_contact' => null,
                'cto_contact' => null,
                'cto_name' => 'John Doe',
                'hr_contact' => null,
                'logo' => 'https://techcorp.com/logo.png',
                'is_mobile_only' => true,
                'hr' => null,
                'plangs' => collect([
                    (object)['name' => 'PHP', 'pivot' => (object)['rating' => 4.5]],
                    (object)['name' => 'JavaScript', 'pivot' => (object)['rating' => 4.0]],
                ]),
                'frameworks' => collect([
                    (object)['name' => 'Laravel', 'pivot' => (object)['rating' => 4.5]],
                    (object)['name' => 'Vue.js', 'pivot' => (object)['rating' => 4.0]],
                ]),
                'feFrameworks' => collect([
                    (object)['name' => 'React', 'pivot' => (object)['rating' => 4.5]],
                    (object)['name' => 'Angular', 'pivot' => (object)['rating' => 4.0]],
                ]),
                'mobilePlangs' => collect([
                    (object)['name' => 'Swift', 'pivot' => (object)['rating' => 4.5]],
                    (object)['name' => 'Kotlin', 'pivot' => (object)['rating' => 4.0]],
                ]),
            ],
            (object)[
                'id' => 2,
                'name' => 'HighTech Solutions',
                'url' => 'https://hightechsolutions.com/',
                'about' => 'HighTech Solutions focuses on innovative solutions with Node.js and Angular.',
                'source_slug' => 'high-tech-solutions',
                'ceo' => (object)['name' => 'John Doe'],
                'ceo_contact' => null,
                'cto_contact' => null,
                'cto_name' => 'Jane Doe',
                'hr_contact' => null,
                'logo' => 'https://hightechsolutions.com/logo.png',
                'is_mobile_only' => false,
                'hr' => null,
                'plangs' => collect([
                    (object)['name' => 'JavaScript', 'pivot' => (object)['rating' => 4.5]],
                    (object)['name' => 'Python', 'pivot' => (object)['rating' => 4.0]],
                ]),
                'frameworks' => collect([
                    (object)['name' => 'Node.js', 'pivot' => (object)['rating' => 4.5]],
                    (object)['name' => 'Angular', 'pivot' => (object)['rating' => 4.0]],
                ]),
                'feFrameworks' => collect([
                    (object)['name' => 'React', 'pivot' => (object)['rating' => 4.5]],
                    (object)['name' => 'Vue.js', 'pivot' => (object)['rating' => 4.0]],
                ]),
                'mobilePlangs' => collect([
                    (object)['name' => 'Swift', 'pivot' => (object)['rating' => 4.5]],
                    (object)['name' => 'Kotlin', 'pivot' => (object)['rating' => 4.0]],
                ]),
            ],
        ]);
    }
}
