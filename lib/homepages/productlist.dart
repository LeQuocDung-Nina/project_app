import 'dart:convert';
import 'package:flutter_staggered_grid_view/flutter_staggered_grid_view.dart';


import '../const.dart';
import '../product/product_new.dart';
import 'package:flutter/material.dart';
import '../constants.dart';
import 'model/Product_model.dart';
import 'wedget/product.dart';



class ProductList extends StatefulWidget {

  const ProductList({Key? key}) : super(key: key);

  @override
  State<ProductList> createState() => _ProductListState();
}

class _ProductListState extends State<ProductList> {
  late final Future<List<Product>> listProduct;

  Future<List<Product>> getProducts() async{
    // const  baseUrl = 'http://demo47.ninavietnam.com.vn/api/product';
    // Dio dio = Dio();
    List<Product> posts = [];

    try{
      final response  = await dio.get(baseUrl);

      if(response.statusCode == 200){
        // print(response.data.runtimeType);
        final mapJson = jsonDecode(response.data);
        if(mapJson!=null){
          for(var post in mapJson['data']){
            final Product a = Product.fromJson(post);
            posts.add(a);
          }
        }
        // print(posts);

      }else{
        debugPrint('Error : ${response.data}');
      }

    } catch(e){
      print(e);
    }
    return posts;
  }

  @override
  void initState() {
    // TODO: implement initState
    super.initState();
    listProduct = getProducts();
  }

  @override
  Widget build(BuildContext context) {
    return Column(
      children: [
        Row(
          mainAxisAlignment: MainAxisAlignment.spaceBetween,
          children:  [
            Text("Hàng mới về",style: TextStyle(fontWeight: FontWeight.w700,fontSize: 17,color: bLtitleColor),),
            GestureDetector(
              onTap: () {
                Navigator.push(context, MaterialPageRoute(builder: (context) => ProductNes(),),);
              },
              child: Text("Tất cả",style: TextStyle(fontWeight: FontWeight.w400,fontSize: 15,color: priceColor),),
            ),
          ],
        ),
        const SizedBox(height: 20,),
        FutureBuilder(
          future: listProduct,
          builder: (context, snapshot) {
          if(snapshot.hasData){
            final list = snapshot.data;
            if(list!.isNotEmpty){
              return AlignedGridView.count(
                shrinkWrap: true,
                physics: const NeverScrollableScrollPhysics(),
                // itemCount: 6,
                itemCount: list.length,
                crossAxisCount: 2,
                mainAxisSpacing: 20,
                crossAxisSpacing: 20,
                itemBuilder: (context, index) =>  ProductItem(product: list[index]));
            }
          }
          return CircularProgressIndicator();
        },),

      ],
    );
  }
}