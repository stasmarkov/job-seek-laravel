<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * The BlogPost model.
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Auth\Models\User> $likes
 * @property-read int|null $likes_count
 * @property-read \Modules\Auth\Models\User|null $user
 * @method static \Database\Factories\BlogPostFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost query()
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlogPost whereUserId($value)
 */
	class BlogPost extends \Eloquent {}
}

namespace App\Models{
/**
 * The comment model.
 *
 * @property int $id
 * @property int $blog_post_id
 * @property int $user_id
 * @property string $body
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\CommentFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereBlogPostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Comment whereUserId($value)
 */
	class Comment extends \Eloquent {}
}

namespace App\Models{
/**
 * THe contact information model.
 *
 * @property int $id
 * @property int $candidate_profile_id
 * @property string $email
 * @property string|null $telegram
 * @property string|null $whatsapp
 * @property string|null $skype
 * @property string|null $phone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Candidate\Models\CandidateProfile|null $candidateProfile
 * @method static \Modules\Candidate\Database\Factories\ContactInformationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Candidate\Models\ContactInformation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Candidate\Models\ContactInformation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Candidate\Models\ContactInformation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Candidate\Models\ContactInformation whereCandidateProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Candidate\Models\ContactInformation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Candidate\Models\ContactInformation whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Candidate\Models\ContactInformation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Candidate\Models\ContactInformation wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Candidate\Models\ContactInformation whereSkype($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Candidate\Models\ContactInformation whereTelegram($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Candidate\Models\ContactInformation whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Candidate\Models\ContactInformation whereWhatsapp($value)
 */
	class ContactInformation extends \Eloquent {}
}

namespace App\Models{
/**
 * The login log.
 *
 * @property int $id
 * @property int $user_id
 * @property string $ip
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Auth\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|LoginLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LoginLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LoginLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|LoginLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoginLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoginLog whereIp($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoginLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LoginLog whereUserId($value)
 */
	class LoginLog extends \Eloquent {}
}

namespace App\Models{
/**
 * The Tag model.
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Vacancy\Models\Vacancy> $vacancies
 * @property-read int|null $vacancies_count
 * @method static \Database\Factories\TagFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereUpdatedAt($value)
 */
	class Tag extends \Eloquent {}
}

namespace App\Models{
/**
 * The user model.
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property mixed|null $password
 * @property string|null $github_id
 * @property string|null $github_token
 * @property string|null $github_refresh_token
 * @property string $status
 * @property string|null $avatar
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $love_reacter_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\BlogPost> $blogPosts
 * @property-read int|null $blog_posts_count
 * @property-read \Modules\Candidate\Models\CandidateProfile|null $candidateProfile
 * @property-read \Modules\Employer\Models\EmployerProfile|null $employerProfile
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\LoginLog> $loginLogs
 * @property-read int|null $login_logs_count
 * @property-read \Cog\Laravel\Love\Reacter\Models\Reacter|null $loveReacter
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Permission> $permissions
 * @property-read int|null $permissions_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Spatie\Permission\Models\Role> $roles
 * @property-read int|null $roles_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Auth\Models\User active()
 * @method static \Modules\Auth\Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Auth\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Auth\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Auth\Models\User permission($permissions, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Auth\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Auth\Models\User role($roles, $guard = null, $without = false)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Auth\Models\User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Auth\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Auth\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Auth\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Auth\Models\User whereGithubId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Auth\Models\User whereGithubRefreshToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Auth\Models\User whereGithubToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Auth\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Auth\Models\User whereLoveReacterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Auth\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Auth\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Auth\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Auth\Models\User whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Auth\Models\User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Auth\Models\User withoutPermission($permissions)
 * @method static \Illuminate\Database\Eloquent\Builder|\Modules\Auth\Models\User withoutRole($roles, $guard = null)
 */
	class User extends \Eloquent implements \Cog\Contracts\Love\Reacterable\Models\Reacterable {}
}

namespace Modules\Candidate\Models{
/**
 * The candidate profile model.
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $description
 * @property string|null $achievements
 * @property string $experience_since
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Candidate\Models\ContactInformation|null $contactInformation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tag> $tags
 * @property-read int|null $tags_count
 * @property-read \Modules\Auth\Models\User|null $user
 * @method static \Modules\Candidate\Database\Factories\CandidateProfileFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|CandidateProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CandidateProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CandidateProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder|CandidateProfile whereAchievements($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CandidateProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CandidateProfile whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CandidateProfile whereExperienceSince($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CandidateProfile whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CandidateProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CandidateProfile whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CandidateProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CandidateProfile whereUserId($value)
 */
	class CandidateProfile extends \Eloquent {}
}

namespace Modules\Employer\Models{
/**
 * The employer profile model.
 *
 * @property int $id
 * @property int $user_id
 * @property string $name
 * @property string $logo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Modules\Auth\Models\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Modules\Vacancy\Models\Vacancy> $vacancies
 * @property-read int|null $vacancies_count
 * @method static \Modules\Employer\Database\Factories\EmployerProfileFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|EmployerProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmployerProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|EmployerProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder|EmployerProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmployerProfile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmployerProfile whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmployerProfile whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmployerProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|EmployerProfile whereUserId($value)
 */
	class EmployerProfile extends \Eloquent {}
}

namespace Modules\Vacancy\Models{
/**
 *
 *
 * @mixin \Illuminate\Database\Eloquent\Builder
 * @property int $id
 * @property string $uuid
 * @property int $employer_profile_id
 * @property string $title
 * @property string $salary
 * @property string $location
 * @property string $schedule
 * @property string $url
 * @property int $featured
 * @property string $description
 * @property string $short_description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $love_reactant_id
 * @property-read \Modules\Employer\Models\EmployerProfile|null $employerProfile
 * @property-read \Cog\Laravel\Love\Reactant\Models\Reactant|null $loveReactant
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Tag> $tags
 * @property-read int|null $tags_count
 * @method static \Illuminate\Database\Eloquent\Builder|Vacancy currentEmployer()
 * @method static \Modules\Vacancy\Database\Factories\VacancyFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Vacancy newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vacancy newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Vacancy query()
 * @method static \Illuminate\Database\Eloquent\Builder|Vacancy whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacancy whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacancy whereEmployerProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacancy whereFeatured($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacancy whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacancy whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacancy whereLoveReactantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacancy whereSalary($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacancy whereSchedule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacancy whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacancy whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacancy whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacancy whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Vacancy whereUuid($value)
 */
	class Vacancy extends \Eloquent implements \Cog\Contracts\Love\Reactable\Models\Reactable {}
}

