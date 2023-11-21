<?php

//namespace Pterodactyl\Models;
//
//use Illuminate\Database\Eloquent\Relations\HasMany;
//use Illuminate\Database\Eloquent\Relations\HasManyThrough;
//
///**
// * @property int $id
// * @property string $short
// * @property string $long
// * @property \Carbon\Carbon $created_at
// * @property \Carbon\Carbon $updated_at
// */
//class Region extends Model
//{
//    /**
//     * The resource name for this model when it is transformed into an
//     * API representation using fractal.
//     */
//    public const RESOURCE_NAME = 'region';
//
//    /**
//     * The table associated with the model.
//     */
//    protected $table = 'regions';
//
//    protected $fillable = [
//        'name'
//    ];
//
//    /**
//     * Fields that are not mass assignable.
//     */
////     protected $guarded = ['id', 'created_at', 'updated_at'];
//
//    /**
//     * Rules ensuring that the raw data stored in the database meets expectations.
//     */
//    public static array $validationRules = [
//        'name' => 'required|string|between:1,60|unique:locations,short'
//    ];
//
//    /**
//     * {@inheritDoc}
//     */
//    public function getRouteKeyName(): string
//    {
//        return $this->getKeyName();
//    }
//
//    /**
//     * Gets the locations in a specified region.
//     */
//    public function locations(): HasMany
//    {
//        return $this->hasMany(Locations::class);
//    }
//
//}
