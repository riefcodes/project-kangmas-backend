class UserModel {
  final int id;
  final String name;
  final String email;
  final String role;
  final String? phoneNumber;
  final TukangProfile? tukangProfile;

  UserModel({
    required this.id,
    required this.name,
    required this.email,
    required this.role,
    this.phoneNumber,
    this.tukangProfile,
  });

  factory UserModel.fromJson(Map<String, dynamic> json) {
    return UserModel(
      id: json['id'],
      name: json['name'],
      email: json['email'],
      role: json['role'],
      phoneNumber: json['phone_number'],
      tukangProfile: json['tukang_profile'] != null
          ? TukangProfile.fromJson(json['tukang_profile'])
          : null,
    );
  }
}

class TukangProfile {
  final int id;
  final String category;
  final double latitude;
  final double longitude;
  final String address;
  final bool isActive;
  final double avgRating;
  final int totalReviews;
  final int basePrice;

  TukangProfile({
    required this.id,
    required this.category,
    required this.latitude,
    required this.longitude,
    required this.address,
    required this.isActive,
    required this.avgRating,
    required this.totalReviews,
    required this.basePrice,
  });

  factory TukangProfile.fromJson(Map<String, dynamic> json) {
    return TukangProfile(
      id: json['id'],
      category: json['category'],
      latitude: (json['latitude'] as num).toDouble(),
      longitude: (json['longitude'] as num).toDouble(),
      address: json['address'],
      isActive: json['is_active'] == 1 || json['is_active'] == true,
      avgRating: (json['avg_rating'] as num).toDouble(),
      totalReviews: json['total_reviews'],
      basePrice: json['base_price'],
    );
  }
}
