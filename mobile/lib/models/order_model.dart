import 'user_model.dart';

class OrderModel {
  final int id;
  final int userId;
  final int tukangId;
  final String description;
  final String? imagePath;
  final String status;
  final int? totalPrice;
  final String createdAt;
  final UserModel? user;
  final UserModel? tukang;

  OrderModel({
    required this.id,
    required this.userId,
    required this.tukangId,
    required this.description,
    this.imagePath,
    required this.status,
    this.totalPrice,
    required this.createdAt,
    this.user,
    this.tukang,
  });

  factory OrderModel.fromJson(Map<String, dynamic> json) {
    return OrderModel(
      id: json['id'],
      userId: json['user_id'],
      tukangId: json['tukang_id'],
      description: json['description'],
      imagePath: json['image_path'],
      status: json['status'],
      totalPrice: json['total_price'],
      createdAt: json['created_at'],
      user: json['user'] != null ? UserModel.fromJson(json['user']) : null,
      tukang: json['tukang'] != null ? UserModel.fromJson(json['tukang']) : null,
    );
  }
}
