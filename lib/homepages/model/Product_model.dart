class Product {
  String? id;
  String? namevi;
  String? descvi;
  String? regularPrice;
  String? salePrice;
  String? discount;
  String? idList;
  String? photo;

  Product(
      {this.id,
        this.namevi,
        this.descvi,
        this.regularPrice,
        this.salePrice,
        this.discount,
        this.idList,
        this.photo});

  Product.fromJson(Map<String, dynamic> json) {
    id = json['id'];
    namevi = json['namevi'];
    descvi = json['descvi'];
    regularPrice = json['regular_price'];
    salePrice = json['sale_price'];
    discount = json['discount'];
    idList = json['id_list'];
    photo = json['photo'];
  }

  Map<String, dynamic> toJson() {
    final Map<String, dynamic> data = new Map<String, dynamic>();
    data['id'] = this.id;
    data['namevi'] = this.namevi;
    data['descvi'] = this.descvi;
    data['regular_price'] = this.regularPrice;
    data['sale_price'] = this.salePrice;
    data['discount'] = this.discount;
    data['id_list'] = this.idList;
    data['photo'] = this.photo;
    return data;
  }
}