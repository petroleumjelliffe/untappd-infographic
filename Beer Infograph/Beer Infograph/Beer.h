//
//  Beer.h
//  Beer Infograph
//
//  Created by Roberto on 6/18/12.
//  Copyright (c) 2012 Malloc Media L.L.C. All rights reserved.
//

#import <Foundation/Foundation.h>
#import <CoreData/CoreData.h>


@interface Beer : NSManagedObject

@property (nonatomic, retain) NSString * beer_id;
@property (nonatomic, retain) NSString * beer_name;
@property (nonatomic, retain) NSString * brewery_name;
@property (nonatomic, retain) NSData * logo;
@property (nonatomic, retain) NSString * style;
@property (nonatomic, retain) NSNumber * unique;
@property (nonatomic, retain) NSString * checkin_id;

@end
